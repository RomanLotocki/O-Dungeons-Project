<?php

namespace App\Controller\Api;

use App\Entity\Race;
use App\Entity\Subrace;
use OpenApi\Annotations as OA;
use App\Repository\RaceRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/api/races", name="app_api_races_")
 * @OA\Tag(name="O'Dungeons Api: Races")
 * @Security(name=null)
 */
class RaceController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns races list",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Race::class, groups={"browse_race"}))
     *     )
     * )
     */
    public function browse(RaceRepository $raceRepo): JsonResponse
    {
        $races = $raceRepo->findAll();

        return $this->json(
            $races,
            Response::HTTP_OK,
            [],
            ["groups" => "browse_race"]
        );
    }

    /**
     * Récupère la classe avec cette id
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id":"\d+"})
     * @OA\Response(
     *     response=200,
     *     description="Returns one race by id",
     *     @Model(type=Race::class, groups={"read_race"})
     *     )
     * )
     */
    public function movie(Race $race = null): JsonResponse
    {
        if ($race === null)
        {
            return $this->json("La race démandée n'a pas été trouvée", Response::HTTP_NOT_FOUND);
        }
        return $this->json($race, Response::HTTP_OK, [], ["groups" => "read_race"]);
    }

    /**
     * Récupère toutes les sous-races d'une race
     * @Route("/{id}/subraces", name="readSubraces", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne toutes les sous-races de la classe demandée",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Subrace::class, groups={"browse_subraces"}))
     *      )
     * )
     */
    public function readSubraces(Race $race = null): JsonResponse
    {
        if ($race === null) {
            return $this->json("La race demandée n'a pas été trouvée", Response::HTTP_NOT_FOUND);
        }

        $subraces = $race->getSubraces();

        return $this->json($subraces, Response::HTTP_OK, [], ["groups" => "browse_subraces"]);
    }

        /**
     * Récupère une race au hasard
     * @Route("/random", name="random_one", methods={"GET"})
     * @OA\Response(
     *      response=200,
     *      description="Retourne une race au hasard",
     *      @Model(type=Race::class, groups={"browse_race"})
     * )
     */
    public function randomOne(RaceRepository $raceRepo): JsonResponse
    {
        $race = $raceRepo->findRandomOne();

        return $this->json($race, Response::HTTP_OK, [], ["groups" => "browse_race"]);
    }
}
