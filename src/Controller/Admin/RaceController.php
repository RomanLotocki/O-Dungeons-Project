<?php

namespace App\Controller\Admin;

use App\Entity\Race;
use App\Form\RaceType;
use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/races", name="app_admin_races_")
 */
class RaceController extends AbstractController
{
    /**
     * @Route("/", name="browser", methods={"GET"})
     *
     * @return Response
     */
    public function browse(RaceRepository $raceRepo): Response
    {
        $races = $raceRepo->findAll();

        return $this->render('admin/race/index.html.twig', [
            'races' => $races,
            'controller' => "RaceController"
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     *
     * @return Response
     */
    public function read(Race $race): Response
    {
        return $this->render('admin/race/read.html.twig', [
            'race' => $race,
            'controller' => "RaceController"
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     *
     * @return Response
     */
    public function edit(Request $request, Race $race, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        // Managing POST method
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute("app_admin_races_read", ["id" => $race->getId()]);
        }

        // Managing GET method
        return $this->renderForm('admin/race/add.html.twig', [
            'race' => $race,
            'form' => $form,
            'controller' => "RaceController",
            'title' => 'Modifier'
        ]);
    }

    /**
     * @Route("/ajouter", name="add", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $race = new Race;

        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        // Managing POST method
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($race);

            $manager->flush();

            return $this->redirectToRoute("app_admin_races_read", ["id" => $race->getId()]);
        }

        // Managing GET method
        return $this->renderForm('admin/race/add.html.twig', [
            'race' => $race,
            'form' => $form,
            'controller' => "RaceController",
            'title' => 'Ajouter'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"}, requirements={"id": "\d+"})
     */
    public function delete(Request $request, Race $race, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$race->getId(), $request->request->get('_token'))){
            $em->remove($race);
            $em->flush();
        }
        
        return $this->redirectToRoute('app_admin_races_browser');
    }
}
