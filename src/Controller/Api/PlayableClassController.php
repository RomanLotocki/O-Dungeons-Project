<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Entity\PlayableClass;
use App\Entity\Ability;
use App\Repository\PlayableClassRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/classes", name="app_api_classes_")
 * @OA\Tag(name="O'Dungeons Api: Classes")
 * @Security(name=null)
 */
class PlayableClassController extends AbstractController
{
    /**
     * Return PlayableClasses list
     * @Route("", name="browse", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Retourne toutes les classes",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=PlayableClass::class, groups={"browse_class"}))
     *     )
     * )
     */
    public function browse(PlayableClassRepository $classRepo): JsonResponse
    {
        $classes = $classRepo->findAll();

        return $this->json(
            $classes,
            Response::HTTP_OK,
            [],
            ["groups" => "browse_class"]
        );
    }

    /**
     * Return a PlayableClass using the id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne la classe demandée via l'id",
     *      @Model(type=PlayableClass::class, groups={"read_class"})
     * )
     */
    public function read(PlayableClass $class = null): JsonResponse
    {
        if ($class === null) {
            return $this->json("La classe demandée n'a pas été trouvée", Response::HTTP_NOT_FOUND);
        }

        return $this->json($class, Response::HTTP_OK, [], ["groups" => "read_class"]);
    }

    /**
     * Return all the abilities associated with a playableClass
     * @Route("/{id}/abilities", name="readAbilities", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne tous les pouvoirs de la classe demandée",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Ability::class, groups={"browse_abilities"}))
     *      )
     * )
     */
    public function readAbilities(PlayableClass $class = null): JsonResponse
    {
        if ($class === null) {
            return $this->json("La classe demandé n'a pas été trouvée", Response::HTTP_NOT_FOUND);
        }

        $abilities = $class->getAbilities();

        return $this->json($abilities, Response::HTTP_OK, [], ["groups" => "browse_abilities"]);
    }

    /**
     * Return two random playableClasses
     * @Route("/random", name="random_one", methods={"GET"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne deux classes au hasard",
     *      @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=PlayableClass::class, groups={"browse_class"}))
     *     )
     * )
     */
    public function randomTwo(PlayableClassRepository $classRepo): JsonResponse
    {
        $class = $classRepo->findRandomTwo();

        return $this->json($class, Response::HTTP_OK, [], ["groups" => "browse_class"]);
    }
}
