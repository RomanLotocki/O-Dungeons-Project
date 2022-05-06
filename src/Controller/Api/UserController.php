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
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/users", name="app_api_users_")
 * @OA\Tag(name="O'Dungeons Api: Utilisateurs")
 */
class UserController extends AbstractController
{
    /**
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
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse
    {
        try {
            $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        } catch (Exception $e) {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }        
        
        $errorList = $validator->validate($user);

        if (count($errorList)>0) {
            return $this->json($errorList, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $plaintextPassword = $user->getPassword();
        $hashedPassword = $hasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return $this->json(['token' => $JWTManager->create($user), 'user' => $user], Response::HTTP_CREATED, [], ["groups" => "read_user"]);
    }

    /**
     * Récupère l'utilisateur avec son id
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
        
        $this->denyAccessUnlessGranted('PROFIL_VIEW', $user);

        return $this->json($user, Response::HTTP_OK, [], ["groups" => "read_user"]);
    }
}
