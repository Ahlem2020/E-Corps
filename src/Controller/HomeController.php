<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

class HomeController extends AbstractController
{
    /**
     * @Route("/Actualites", name="home")
     */
    public function index(): Response
    {
        //on appelle la liste des tous les evenements
        $Event=$this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('home/index.html.twig', [
            'Event' => $Event
        ]);
    }

    /**
     * @Route("/Actualites/Events", name="events_Client")
     */
    public function listEvent(): Response
    {
        //on appelle la liste des tous les evenements
        $Event=$this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('home/Events.html.twig', [
            'Event' => $Event
        ]);
    }/*
    /**
     *
     * @Route("/search", name="ajax_search")
     * @Method("GET")
     */
 /*   public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');

        $entities =  $em->getRepository('Event:Entity')->findEntitiesByString($requestString);

        if(!$entities) {
            $result['entities']['error'] = "keine Einträge gefunden";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getFoo();
        }

        return $realEntities;
    }
*/
}
