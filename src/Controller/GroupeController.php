<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe", name="groupe_admin", methods={"GET"})
     */
    public function index(): Response
    {
        $groupes = $this->getDoctrine()
            ->getRepository(Groupe::class)
            ->findAll();

        return $this->render('groupe/index.html.twig', [
            'groupes' => $groupes,
        ]);
    }

    /**
     * @Route("/groupe/new", name="groupe_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->flush();

            return $this->redirectToRoute('groupe_admin');
        }

        return $this->render('groupe/new.html.twig', [
            'groupe' => $groupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/groupe/{idclass}", name="groupe_show", methods={"GET"})
     * @param Groupe $groupe
     * @return Response
     */
    public function show(Groupe $groupe): Response
    {
        return $this->render('groupe/show.html.twig', [
            'groupe' => $groupe,
        ]);
    }


    /**
     * @Route("/{idclass}/edit", name="groupe_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Groupe $groupe
     * @return Response
     */
    public function edit(Request $request, Groupe $groupe): Response
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('groupe_admin');
        }

        return $this->render('groupe/edit.html.twig', [
            'groupe' => $groupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idclass}", name="groupe_delete", methods={"POST"})
     * @param Request $request
     * @param Groupe $groupe
     * @return Response
     */
    public function delete(Request $request, Groupe $groupe): Response
    {
        if ($this->isCsrfTokenValid('delete' . $groupe->getIdclass(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('groupe_admin');
    }
}
