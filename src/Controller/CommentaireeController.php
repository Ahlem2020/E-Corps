<?php

namespace App\Controller;

use App\Entity\Commentairee;
use App\Form\CommentaireeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentairee")
 */
class CommentaireeController extends AbstractController
{
    /**
     * @Route("/", name="commentairee_index", methods={"GET"})
     */
    public function index(): Response
    {
        $commentairees = $this->getDoctrine()
            ->getRepository(Commentairee::class)
            ->findAll();

        return $this->render('commentairee/index.html.twig', [
            'commentairees' => $commentairees,
        ]);
    }

    /**
     * @Route("/new", name="commentairee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentairee = new Commentairee();
        $form = $this->createForm(CommentaireeType::class, $commentairee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentairee);
            $entityManager->flush();

            return $this->redirectToRoute('commentairee_index');
        }

        return $this->render('commentairee/new.html.twig', [
            'commentairee' => $commentairee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idC}", name="commentairee_show", methods={"GET"})
     */
    public function show(Commentairee $commentairee): Response
    {
        return $this->render('commentairee/show.html.twig', [
            'commentairee' => $commentairee,
        ]);
    }

    /**
     * @Route("/{idC}/edit", name="commentairee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commentairee $commentairee): Response
    {
        $form = $this->createForm(CommentaireeType::class, $commentairee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentairee_index');
        }

        return $this->render('commentairee/edit.html.twig', [
            'commentairee' => $commentairee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idC}", name="commentairee_delete", methods={"POST"})
     */
    public function delete(Request $request, Commentairee $commentairee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentairee->getIdC(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentairee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentairee_index');
    }
}
