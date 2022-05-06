<?php

namespace App\Controller\Api;

use App\Entity\Ability;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * @Route("/api/abilities", name="app_api_abilities_")
 * @OA\Tag(name="O'Dungeons Api: Pouvoirs")
 * @Security(name=null)
 */
class AbilityController extends AbstractController
{
    /**
     * Récupère le pouvoir avec cette id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne le pouvoir demandée via l'id",
     *      @Model(type=Ability::class, groups={"read_abilities"})
     * )
     */
    public function read(Ability $ability = null): JsonResponse
    {
        if ($ability === null) {
            return $this->json("Le pouvoir demandé n'a pas été trouvé", Response::HTTP_NOT_FOUND);
        }

        return $this->json($ability, Response::HTTP_OK, [], ["groups" => "read_abilities"]);
    }
}
