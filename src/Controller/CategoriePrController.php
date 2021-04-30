<?php

namespace App\Controller;

use App\Entity\CategoriePr;
use App\Form\CategoriePrType;
use App\Repository\CategoriePrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Back/categoriepr")
 */
class CategoriePrController extends AbstractController
{
    /**
     * @Route("/", name="categorie_pr_index", methods={"GET"})
     */
    public function index(CategoriePrRepository $categoriePrRepository): Response
    {
        return $this->render('/Back/categorie_pr/index.html.twig', [
            'categorie_prs' => $categoriePrRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_pr_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoriePr = new CategoriePr();
        $form = $this->createForm(CategoriePrType::class, $categoriePr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriePr);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_pr_index');
        }

        return $this->render('/Back/categorie_pr/new.html.twig', [
            'categorie_pr' => $categoriePr,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_pr_show", methods={"GET"})
     */
    public function show(CategoriePr $categoriePr): Response
    {
        return $this->render('/Back/categorie_pr/show.html.twig', [
            'categorie_pr' => $categoriePr,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_pr_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoriePr $categoriePr): Response
    {
        $form = $this->createForm(CategoriePrType::class, $categoriePr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_pr_index');
        }

        return $this->render('/Back/categorie_pr/edit.html.twig', [
            'categorie_pr' => $categoriePr,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_pr_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoriePr $categoriePr): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriePr->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriePr);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_pr_index');
    }
}
