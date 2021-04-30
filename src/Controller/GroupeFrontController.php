<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/groupe")
 */
class GroupeFrontController extends AbstractController
{


    /**
     * @Route("/", name="groupe_index", methods={"GET"})
     */
    public function front(): Response
    {
        $groupes = $this->getDoctrine()
            ->getRepository(Groupe::class)
            ->findAll();

        return $this->render('groupe/indexfront.html.twig', [
            'groupes' => $groupes,
        ]);
    }

    /**
     * @Route("/{idclass}", name="groupe_show_front", methods={"GET"})
     * @param Groupe $groupe
     * @return Response
     */
    public function show(Groupe $groupe): Response
    {
        return $this->render('groupe/showfront.html.twig', [
            'groupe' => $groupe,
        ]);
    }



}
