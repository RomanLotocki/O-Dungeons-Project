<?php

namespace App\Controller\Admin;

use App\Entity\PlayableClass;
use App\Form\PlayableClassType;
use App\Repository\PlayableClassRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/playable/class")
 */
class PlayableClassController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_playable_class_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $playableClasses = $entityManager
            ->getRepository(PlayableClass::class)
            ->findAll();

        return $this->render('admin/playable_class/index.html.twig', [
            'playable_classes' => $playableClasses,
            'controller' => 'PlayableClassController'
        ]);
    }

    /**
     * @Route("/ajouter", name="app_admin_playable_class_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playableClass = new PlayableClass();
        $form = $this->createForm(PlayableClassType::class, $playableClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playableClass);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_playable_class_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/playable_class/new.html.twig', [
            'playable_class' => $playableClass,
            'form' => $form,
            'controller' => 'PlayableClassController'
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_playable_class_show", methods={"GET"})
     */
    public function show(PlayableClass $playableClass): Response
    {
        return $this->render('admin/playable_class/show.html.twig', [
            'playable_class' => $playableClass,
            'controller' => 'PlayableClassController'
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="app_admin_playable_class_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PlayableClass $playableClass, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlayableClassType::class, $playableClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_playable_class_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/playable_class/edit.html.twig', [
            'playable_class' => $playableClass,
            'form' => $form,
            'controller' => 'PlayableClassController'
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_playable_class_delete", methods={"POST"})
     */
    public function delete(Request $request, PlayableClass $playableClass, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playableClass->getId(), $request->request->get('_token'))) {
            $entityManager->remove($playableClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_playable_class_index', [], Response::HTTP_SEE_OTHER);
    }
}
