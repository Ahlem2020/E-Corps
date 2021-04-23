<?php

namespace App\Controller;

use App\Entity\Participante;
use App\Entity\Event;
use App\Form\ParticipanteType;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ParticipanteController extends AbstractController
{
    /**
     * @Route("/participation", name="participation")
     */
    public function index(): Response
    {


        return $this->render('participante/index.html.twig', [
            'controller_name' => 'ParticipanteController',
        ]);
    }
    /**
     * @return Response
     * @Route ("concour/listPadmin",name="listPadmin")
     */
    public function ListEvent (){
        $repo=$this->getDoctrine()->getRepository(Participante::class);
        $participante=$repo->findAll();
        return $this->render('Event/index.html.twig',['participante'=>$participante]);
    }

    /**
     * @Route ("participation/ajouterParticipant",name="ajouterParticipant")
     */

    public function ajouterParticipant (Request $request){
        $Participante=new Participante();
        $form=$this->createForm(ParticipanteType::class,$Participante);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Participante);
            $em->flush();
            return $this->redirectToRoute('listTTParticipants');
        }
        return $this->render("participation/new.html.twig",[
            'form'=>$form->createView(),
        ]);
    }

    public function supprimerParticipant($id){
        $repo=$this->getDoctrine()->getRepository(Participante::class);
        $participante=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($participante);
        $em->flush();
        return $this->redirectToRoute('events_Client');
    }





}
