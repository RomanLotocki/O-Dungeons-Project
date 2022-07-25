<?php

namespace App\Controller\Api;

use App\Entity\Avatar;
use OpenApi\Annotations as OA;
use App\Repository\AvatarRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * @Route("/api/avatars", name="app_api_avatars_")
 * @OA\Tag(name="O'Dungeons Api: Avatars")
 * @Security(name=null)
 */
class AvatarController extends AbstractController
{
    /**
     * Return avatars list
     * @Route("", name="browse", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Retourne la liste des avatars",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Avatar::class, groups={"browse_avatars"}))
     *     )
     * )
     */
    public function browse(AvatarRepository $avatarRepo): JsonResponse
    {
        $avatars = $avatarRepo->findAll();

        return $this->json(
            $avatars,
            Response::HTTP_OK,
            [],
            ["groups" => "browse_avatars"]
        );
    }
}
