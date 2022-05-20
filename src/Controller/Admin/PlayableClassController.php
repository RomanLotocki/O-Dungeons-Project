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
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Race;

/**
 * This is the controller for the BREAD methods managing the PlayableClass entity
 * @Route("/admin/classe")
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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $playableClass = new PlayableClass();
        $form = $this->createForm(PlayableClassType::class, $playableClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Checking if the field file input is not empty
            if ($form['imageFile']->getData() === null) {
                $this->addFlash(
                    'error',
                    'Veuillez téléverser une image'
                );
            }
            else {
                // Creating a file name using the name of the new playableClass
                $fileName = $slugger->slug($playableClass->getName())->lower().".png";
                // Getting the file and move it into the asset folder
                $file = $form['imageFile']->getData();
                $file->move('asset', $fileName);
                // Adding the image file path into the DB
                $playableClass->setImageUrl('asset/'.$fileName);


                $entityManager->persist($playableClass);
                $entityManager->flush();

                return $this->redirectToRoute('app_admin_playable_class_show', ['id' => $playableClass->getId()], Response::HTTP_SEE_OTHER);
            }
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
    public function edit(Request $request, PlayableClass $playableClass, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PlayableClassType::class, $playableClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form['imageFile']->getData() !== null) {
                $fileName = $slugger->slug($playableClass->getName())->lower().".png";
                $file = $form['imageFile']->getData();
                $file->move('asset', $fileName);
            
                $playableClass->setImageUrl('asset/'.$fileName);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_playable_class_show', ['id' => $playableClass->getId()], Response::HTTP_SEE_OTHER);
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
        // Deleting the image file in the asset folder at the same time as the PlayableClass in the DB.
        $imageFile = $playableClass->getImageUrl();
        if (file_exists($imageFile)) {
            unlink($imageFile);
        }
        
        if ($this->isCsrfTokenValid('delete'.$playableClass->getId(), $request->request->get('_token'))) {
            $entityManager->remove($playableClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_playable_class_index', [], Response::HTTP_SEE_OTHER);
    }
}
