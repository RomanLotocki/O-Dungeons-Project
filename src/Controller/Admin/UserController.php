<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserAddType;
use App\Form\UserEditType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * This is the controller for the BREAD methods managing the User entity
 * For the edit of the user, there are two different methods : one for the password and the other one for all the other properties
 * @Route("/admin/utilisateur")
 */
class UserController extends AbstractController
{
    /**
     * Return all the users
     * @Route("/", name="app_admin_user_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
            'controller' => 'UserController'
        ]);
    }

    /**
     * Create a new user
     * @Route("/ajouter", name="app_admin_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserAddType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hashing the password of the user before adding the user in DB
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'controller' => 'UserController'
        ]);
    }

    /**
     * Show a specific user
     * @Route("/{id}", name="app_admin_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
            'controller' => 'UserController'
        ]);
    }

    /**
     * Edit user except password
     * @Route("/{id}/modifier", name="app_admin_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'controller' => 'UserController'
        ]);
    }

    /**
     * Edit user password
     * @Route("/{id}/mot-de-passe", name="app_admin_user_edit_password", methods={"GET", "POST"})
     */
    public function editPassword(Request $request,User $user, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager, ValidatorInterface $validator): Response
    {
        // There are three visible fields in the form and one hidden for the CSRF protection
        $oldPassword = $request->get('password_old');
        $newPassword = $request->get('password_new');
        $passwordConfirmation = $request->get('password_new_confirmation');

        // Checking if the form is submitted and if the CSRF token is valid
        if ($request->getMethod() === "POST" && $this->isCsrfTokenValid('password'.$user->getId(), $request->request->get('_token'))) {
            
            // Checking if the field old password is the correct password and if the new password is the same in the two other fields
            if ($hasher->isPasswordValid($user, $oldPassword) && $newPassword === $passwordConfirmation) {

                // Checking if the new password length is more than 8 characters (as we defined assert rule in the entity)
                $user->setPassword($newPassword);

                $errors = $validator->validate($user);

                if (count($errors) > 0) {

                    foreach ($errors as $error) {
                        $this->addFlash(
                            'error',
                            $error->getMessage()
                        );
                    }
                }
                // If the new password length is more than 8 characters, hashing it and store in database
                else {
                    
                    $user->setPassword($hasher->hashPassword($user, $newPassword));
                    $manager->flush();

                    return $this->redirectToRoute('app_admin_user_show', ["id" => $user->getId()]);
                }                

            }
            // If the old password is wrong or if the new passwords are not the same, the user stay on form page and get an error message
            else {
                $this->addFlash(
                    'error',
                    'Mot de passe incorrecte'
                );
            }
        }

        // Rendering the template with the password form
        return $this->render('admin/user/edit_password.html.twig', [
            'user' => $user,
            'controller' => 'UserController'
        ]);
    }

    /**
     * Delete a user
     * @Route("/{id}", name="app_admin_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
