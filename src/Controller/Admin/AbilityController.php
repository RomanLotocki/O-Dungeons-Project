<?php

namespace App\Controller\Admin;

use App\Entity\Ability;
use App\Form\AbilityType;
use App\Repository\AbilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This is the controller for the BREAD methods managing the Ability entity
 * @Route("/admin/ability")
 */
class AbilityController extends AbstractController
{
    /**
     * Returns all abilities
     * @Route("/", name="app_admin_ability_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $abilities = $entityManager
            ->getRepository(Ability::class)
            ->findAll();

        return $this->render('admin/ability/index.html.twig', [
            'abilities' => $abilities,
            'controller' => 'AbilityController'
        ]);
    }

    /**
     * Create a new ability
     * @Route("/ajouter", name="app_admin_ability_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ability = new Ability();
        $form = $this->createForm(AbilityType::class, $ability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ability);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_ability_show', ["id" => $ability->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ability/new.html.twig', [
            'ability' => $ability,
            'form' => $form,
            'controller' => 'AbilityController'
        ]);
    }

    /**
     * Show a specific ability
     * @Route("/{id}", name="app_admin_ability_show", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function show(Ability $ability): Response
    {
        return $this->render('admin/ability/show.html.twig', [
            'ability' => $ability,
            'controller' => 'AbilityController'
        ]);
    }

    /**
     * Edit an existing ability
     * @Route("/{id}/modifier", name="app_admin_ability_edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Ability $ability, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AbilityType::class, $ability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_ability_index', ["id" => $ability->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ability/edit.html.twig', [
            'ability' => $ability,
            'form' => $form,
            'controller' => 'AbilityController'
        ]);
    }

    /**
     * Delete an existing ability
     * @Route("/{id}", name="app_admin_ability_delete", methods={"POST"}, requirements={"id": "\d+"})
     */
    public function delete(Request $request, Ability $ability, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ability->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ability);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_ability_index', [], Response::HTTP_SEE_OTHER);
    }
}
