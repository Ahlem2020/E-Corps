<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/seance")
 */
class SeanceController extends Controller
{
    /**
     * @Route("/", name="seance_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $Allseances = $this->getDoctrine()
            ->getRepository(Seance::class)
            ->findAll();
        $seances = $this->get('knp_paginator')->paginate(
            $Allseances, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        return $this->render('seance/indexclient.html.twig', [
            'seances' => $seances,
        ]);
    }

    /**
     * @Route("/new", name="seance_new", methods={"GET","POST"})
     * @param Request $request
     * @param FlashyNotifier $flashy
     * @return Response
     */
    public function new(Request $request, FlashyNotifier $flashy): Response
    {
        $seance = new Seance();

        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $seance->setZeroLikes();
            $seance->setGroupe("yoga");
            $entityManager->persist($seance);
            $entityManager->flush();
            $flashy->success('Event created!');

            return $this->redirectToRoute('seance_index');
        }

        return $this->render('seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idseance}", name="seance_show", methods={"GET"})
     * @param Seance $seance
     * @return Response
     */
    public function show(Seance $seance): Response
    {
        return $this->render('seance/show.html.twig', [
            'seance' => $seance,
        ]);
    }

    /**
     * @Route("/frontshow/{idseance}", name="seance_showfront", methods={"GET"})
     * @param Seance $seance
     * @return Response
     */
    public function sho(Seance $seance): Response
    {
        return $this->render('seance/showfront.html.twig', [
            'seance' => $seance,
        ]);
    }

    /**
     * @Route("/{idseance}/edit", name="seance_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Seance $seance
     * @return Response
     */
    public function edit(Request $request, Seance $seance): Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seance_index');
        }

        return $this->render('seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idseance}", name="seance_delete", methods={"POST"})
     * @param Request $request
     * @param Seance $seance
     * @return Response
     */
    public function delete(Request $request, Seance $seance): Response
    {
        if ($this->isCsrfTokenValid('delete' . $seance->getIdseance(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seance_index');
    }

    /**
     * @Route("/trie/dateasc" , name="seance_trie1", methods={"GET","POST"})
     * @param NormalizerInterface $Normalizer
     * @return Response
     * @throws ExceptionInterface
     */
    public function trierDateAs(NormalizerInterface $Normalizer): Response
    {
        $seancesRepository = $this->getDoctrine()->getRepository(Seance::class);

        $query = $seancesRepository->createQueryBuilder('p')
            ->orderBy('p.dateseance', 'ASC')
            ->getQuery();

        $seances = $query->getResult();
        $jsonContent = $Normalizer->normalize($seances, 'json', ['groups' => 'seance:read']);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @Route("/trie/datedesc" , name="seance_trie2", methods={"GET","POST"})
     * @param NormalizerInterface $Normalizer
     * @return Response
     * @throws ExceptionInterface
     */
    public function trierDateDesc(NormalizerInterface $Normalizer): Response
    {
        $seancesRepository = $this->getDoctrine()->getRepository(Seance::class);

        $query = $seancesRepository->createQueryBuilder('p')
            ->orderBy('p.dateseance', 'DESC')
            ->getQuery();

        $seances = $query->getResult();

        $jsonContent = $Normalizer->normalize($seances, 'json', ['groups' => 'seance:read']);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @Route("/trie/titreasc" , name="seance_trie3", methods={"GET","POST"})
     * @param NormalizerInterface $Normalizer
     * @return Response
     * @throws ExceptionInterface
     */
    public function trierTitre(NormalizerInterface $Normalizer): Response
    {
        $seancesRepository = $this->getDoctrine()->getRepository(Seance::class);

        $query = $seancesRepository->createQueryBuilder('p')
            ->orderBy('p.titreseance', 'ASC')
            ->getQuery();

        $seances = $query->getResult();

        $jsonContent = $Normalizer->normalize($seances, 'json', ['groups' => 'seance:read']);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @Route("/trie/titredesc" , name="seance_trie4", methods={"GET","POST"})
     * @param NormalizerInterface $Normalizer
     * @return Response
     * @throws ExceptionInterface
     */
    public function trierTitreDesc(NormalizerInterface $Normalizer): Response
    {
        $seancesRepository = $this->getDoctrine()->getRepository(Seance::class);

        $query = $seancesRepository->createQueryBuilder('p')
            ->orderBy('p.titreseance', 'DESC')
            ->getQuery();

        $seances = $query->getResult();

        $jsonContent = $Normalizer->normalize($seances, 'json', ['groups' => 'seance:read']);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @Route("/like/{idseance}" , name="seance_like", methods={"GET","POST"})
     * @param int $idseance
     * @return Response
     */
    public function like(int $idseance): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $seance = $entityManager->getRepository(Seance::class)->find($idseance);

        if (!$seance) {
            throw $this->createNotFoundException(
                'No product found for id ' . $idseance
            );
        }
        $seance->incrementLikeCount();
        $entityManager->flush();

        return $this->redirectToRoute('seance_index');
    }

}
