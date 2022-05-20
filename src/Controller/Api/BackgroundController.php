<?php

namespace App\Controller\Api;

use App\Entity\Background;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * @Route("/api/backgrounds", name="app_api_backgrounds_")
 * @OA\Tag(name="O'Dungeons Api: Historiques")
 * @Security(name=null)
 */
class BackgroundController extends AbstractController
{
    /**
     * Return backgrounds list
     * @Route("", name="browse", methods={"GET"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne tous les historiques",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Background::class, groups={"browse_backgrounds"}))
     *      )
     * )
     */
    public function browse(BackgroundRepository $backgroundRepository): JsonResponse
    {
        $backgrounds = $backgroundRepository->findAll();

        return $this->json($backgrounds, Response::HTTP_OK, [], ["groups" => "browse_backgrounds"]);
    }

    /**
     * Return the background data using the id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne tous les historiques",
     *      @Model(type=Background::class, groups={"read_backgrounds"})
     * )
     */
    public function read(Background $background = null): JsonResponse
    {
        if ($background === null) {
            return $this->json("L'historique demandé n'a pas été trouvé", Response::HTTP_NOT_FOUND);
        }

        return $this->json($background, Response::HTTP_OK, [], ["groups" => "read_backgrounds"]);
    }
}
