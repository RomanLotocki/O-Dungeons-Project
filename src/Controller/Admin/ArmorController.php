<?php

namespace App\Controller\Admin;

use App\Entity\Armor;
use App\Form\ArmorType;
use App\Repository\ArmorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/armor")
 */
class ArmorController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_armor_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $armors = $entityManager
            ->getRepository(Armor::class)
            ->findAll();

        return $this->render('admin/armor/index.html.twig', [
            'armors' => $armors,
            'controller' => 'ArmorController'
        ]);
    }

    /**
     * @Route("/ajouter", name="app_admin_armor_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $armor = new Armor();
        $form = $this->createForm(ArmorType::class, $armor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($armor);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_armor_show', ["id" => $armor->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/armor/new.html.twig', [
            'armor' => $armor,
            'form' => $form,
            'controller' => 'ArmorController'
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_armor_show", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function show(Armor $armor): Response
    {
        return $this->render('admin/armor/show.html.twig', [
            'armor' => $armor,
            'controller' => 'ArmorController'
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="app_admin_armor_edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Armor $armor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArmorType::class, $armor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_armor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/armor/edit.html.twig', [
            'armor' => $armor,
            'form' => $form,
            'controller' => 'ArmorController'
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_armor_delete", methods={"POST"}, requirements={"id": "\d+"})
     */
    public function delete(Request $request, Armor $armor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$armor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($armor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_armor_index', [], Response::HTTP_SEE_OTHER);
    }
}
