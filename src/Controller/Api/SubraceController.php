<?php

namespace App\Controller\Api;

use App\Entity\Subrace;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/subraces", name="app_api_subraces_")
 * @OA\Tag(name="O'Dungeons Api: Sous-races")
 */
class SubraceController extends AbstractController
{
    /**
     * Récupère la sous-race avec cette id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne la sous-race demandée via l'id",
     *      @Model(type=Subrace::class, groups={"read_subraces"})
     * )
     */
    public function read(Subrace $subrace = null): JsonResponse
    {
        if ($subrace === null) {
            return $this->json("La sous-race demandée n'a pas été trouvée", Response::HTTP_NOT_FOUND);
        }

        return $this->json($subrace, Response::HTTP_OK, [], ["groups" => "read_subraces"]);
    }
}
