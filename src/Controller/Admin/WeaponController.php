<?php

namespace App\Controller\Admin;

use App\Entity\Weapon;
use App\Form\WeaponType;
use App\Repository\WeaponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/armes", name="app_admin_weapon_")
 */
class WeaponController extends AbstractController
{
    /**
     * @Route("/", name="browser", methods={"GET"})
     */
    public function browse(EntityManagerInterface $entityManager): Response
    {
        $weapons = $entityManager
            ->getRepository(Weapon::class)
            ->findAll();

        return $this->render('admin/weapon/index.html.twig', [
            'weapons' => $weapons,
            'controller' => 'WeaponController'
        ]);
    }

    /**
     * @Route("/ajouter", name="add", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weapon = new Weapon();
        $form = $this->createForm(WeaponType::class, $weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($weapon);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_weapon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/weapon/new.html.twig', [
            'weapon' => $weapon,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"})
     */
    public function show(Weapon $weapon): Response
    {
        return $this->render('admin/weapon/show.html.twig', [
            'weapon' => $weapon,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Weapon $weapon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WeaponType::class, $weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_weapon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/weapon/edit.html.twig', [
            'weapon' => $weapon,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Weapon $weapon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weapon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weapon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_weapon_index', [], Response::HTTP_SEE_OTHER);
    }
}
