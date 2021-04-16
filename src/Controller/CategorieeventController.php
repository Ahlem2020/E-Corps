<?php

namespace App\Controller;

use App\Entity\Categorieevent;
use App\Form\CategorieeventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorieevent")
 */
class CategorieeventController extends AbstractController
{
    /**
     * @Route("/", name="categorieevent_index", methods={"GET"})
     */
    public function index(): Response
    {
        $categorieevents = $this->getDoctrine()
            ->getRepository(Categorieevent::class)
            ->findAll();

        return $this->render('categorieevent/index.html.twig', [
            'categorieevents' => $categorieevents,
        ]);
    }

    /**
     * @Route("/new", name="categorieevent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorieevent = new Categorieevent();
        $form = $this->createForm(CategorieeventType::class, $categorieevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieevent);
            $entityManager->flush();

            return $this->redirectToRoute('categorieevent_index');
        }

        return $this->render('categorieevent/new.html.twig', [
            'categorieevent' => $categorieevent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCategoriee}", name="categorieevent_show", methods={"GET"})
     */
    public function show(Categorieevent $categorieevent): Response
    {
        return $this->render('categorieevent/show.html.twig', [
            'categorieevent' => $categorieevent,
        ]);
    }

    /**
     * @Route("/{idCategoriee}/edit", name="categorieevent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorieevent $categorieevent): Response
    {
        $form = $this->createForm(CategorieeventType::class, $categorieevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieevent_index');
        }

        return $this->render('categorieevent/edit.html.twig', [
            'categorieevent' => $categorieevent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCategoriee}", name="categorieevent_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorieevent $categorieevent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieevent->getIdCategoriee(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieevent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorieevent_index');
    }
}
