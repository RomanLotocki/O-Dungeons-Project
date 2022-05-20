<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Form\UserAddType;
use App\Form\UserEditType;
use App\Repository\AvatarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator;

/**
 * Managing Api routes associated to the user entity 
 * @Route("/api/users", name="app_api_users_")
 * @OA\Tag(name="O'Dungeons Api: Utilisateurs")
 */
class UserController extends AbstractController
{
    /**
     * Create a user through API routes
     * @Route("", name="add", methods={"POST"})
     * 
     * @OA\Response(
     *      response=201,
     *      description="Retourne l'utilisateur créé avec son token JWT",
     *      @Model(type=User::class, groups={"read_user"})      
     * )
     * @OA\RequestBody(
     *      @Model(type=UserAddType::class)
     * )
     * @Security(name=null)
     */
    public function add(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $hasher,
        JWTTokenManagerInterface $JWTManager,
        AvatarRepository $avatarRepository
    ): JsonResponse
    {
        // Get datas from the request content (json format) and try to deserialize it.
        try {
            $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        
        }
        // If it is not possible to deserialize, catch and return an error.
        catch (Exception $e) {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }        
        
        // Verify if the inputs are valid according to the asserts in the User entity.
        $errorList = $validator->validate($user);

        if (count($errorList)>0) {
            return $this->json($errorList, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Getting and hashing the password before sending in the DB.
        $plaintextPassword = $user->getPassword();
        $hashedPassword = $hasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        
        // By default, the created user has no avatars. Setting a default avatar to the new user.
        $user->setAvatar($avatarRepository->findOneBy(["name" => ["Default"]]));      

        $em->persist($user);
        $em->flush();

        return $this->json(['token' => $JWTManager->create($user), 'user' => $user], Response::HTTP_CREATED, [], ["groups" => "read_user"]);
    }

    /**
     * Return the user data using the id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne l'utilisateur demandé via l'id",
     *      @Model(type=User::class, groups={"read_user"})
     * )
     */
    public function read(User $user = null) : JsonResponse
    {
        if ($user === null) {
            return $this->json("L'utilisateur demandé n'a pas été trouvé", Response::HTTP_NOT_FOUND);
        }
        
        // Authorize this road only for the current user authenticated with JWT
        $this->denyAccessUnlessGranted('PROFIL_VIEW', $user);

        return $this->json($user, Response::HTTP_OK, [], ["groups" => "read_user"]);
    }

    /**
     * Edit a user through the API
     * @Route("/{id}", name="edit", methods={"PUT"}, requirements={"id": "\d+"})
     * 
     * @OA\Response(
     *      response=200,
     *      description="Retourne l'utilisateur modifié",
     *      @Model(type=User::class, groups={"read_user"})      
     * )
     * @OA\RequestBody(
     *      @Model(type=UserEditType::class)
     * )
     */
    public function edit(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        User $user = null,
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse
    {
        // If the user doesn't exist: return an 404 error.
        if ($user === null) {
            return $this->json("Utilisateur non trouvé", Response::HTTP_NOT_FOUND);
        }

        $this->denyAccessUnlessGranted("PROFIL_EDIT", $user);

        try {
            $userNew = $serializer->deserialize($request->getContent(), User::class, 'json');
        } catch (Exception $e) {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        };

        // Setting the current user datas with the datas sent through the API.
        $user->setEmail($userNew->getEmail());
        $user->setLastName($userNew->getLastName());
        $user->setFirstName($userNew->getFirstName());
        $user->setAvatar($userNew->getAvatar());
        $errorList = $validator->validate($user);
        
        if (count($errorList)>0) {
            return $this->json($errorList, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->flush();

        return $this->json(['user' => $user], Response::HTTP_OK, [], ["groups" => "read_user"]);
    }

    /**
     * Edit a user password through the API
     * @Route("/{id}/password", name="editPassword", methods={"PATCH"}, requirements={"id": "\d+"})
     * 
     * @OA\Response(
     *      response=200,
     *      description="Retourne l'utilisateur modifié",
     *      @Model(type=User::class, groups={"read_user"})      
     * )
     * @OA\RequestBody(
     *      @OA\JsonContent(
     *          example={
     *             "oldPassword": "old",
     *             "newPassword": "new"
     *         }
     *      )      
     * )
     */
    public function editPassword(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        User $user = null,
        JWTTokenManagerInterface $JWTManager,
        UserPasswordHasherInterface $hasher
    ): JsonResponse
    {
        
        // Verify if the user exist.
        if ($user === null) {
            return $this->json("Utilisateur non trouvé", Response::HTTP_NOT_FOUND);
        }
        $this->denyAccessUnlessGranted("PROFIL_EDIT", $user);
        
        // Get the users inputs and convert Json datas into a PHP variable.
        try {
            $passwords = json_decode($request->getContent());
        } catch (Exception $e) {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        };
        
        // Verify if the old password given by the user is matching with the hashed password in the DB.
        if($hasher->isPasswordValid($user, $passwords->oldPassword)){

            // Replace the old password with the new one.
            $user->setPassword($passwords->newPassword);

            // Verify asserts in the user entity.
            $errorList = $validator->validate($user);
                    
            if (count($errorList)>0) {
                return $this->json($errorList, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Hashing the new password.
            $hashedPassword = $hasher->hashPassword(
                $user,
                $passwords->newPassword
            );
    
            // Setting the new hashed password.
            $user->setPassword($hashedPassword);
        }
        // If the old passwords are not matching.
        else {
            return $this->json("Invalid credentials.", Response::HTTP_UNAUTHORIZED);
        }

        $em->flush();

        return $this->json(['token' => $JWTManager->create($user), 'user' => $user], Response::HTTP_OK, [], ["groups" => "read_user"]);
    }

    /**
     * Edit a user avatar through the API
     * @Route("/{id}/avatar", name="editAvatar", methods={"PATCH"}, requirements={"id": "\d+"})
     *
     * @OA\Response(
     *      response=200,
     *      description="Retourne l'utilisateur modifié",
     *      @Model(type=User::class, groups={"read_user"})      
     * )
     * @OA\RequestBody(
     *      @OA\JsonContent(
     *          example={
     *             "avatar": 1,
     *         }
     *      )      
     * )
     */
    public function editAvatar(
        User $user,
        AvatarRepository $avatarRepository,
        EntityManagerInterface $em,
        Request $request
    ) {
        // Verify if the user exist.
        if ($user === null) {
            return $this->json("Utilisateur non trouvé", Response::HTTP_NOT_FOUND);
        }
        $this->denyAccessUnlessGranted("PROFIL_EDIT", $user);

        // Decode API request content into an object. Get avatar datas through the id sent by the user.
        try {
            $avatar = $avatarRepository->find(json_decode($request->getContent())->avatar);
        } catch (Exception $e) {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Verify if the avatar sent by the user exists in the DB.
        if ($avatar === null) {
            return $this->json(
                "Avatar non trouvé",
                Response::HTTP_NOT_FOUND
            );
        }

        // Setting the new avatar for the user.
        $user->setAvatar($avatar);

        $em->flush();

        return $this->json($user, Response::HTTP_OK, [], ["groups" => ["read_user"]]);
    }
}
