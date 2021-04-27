<?php

namespace App\Controller;

use App\Entity\Commentairee;
use App\Form\CommentaireeType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Entity\Categorieevent;



class HomeController extends AbstractController
{
    /**
     * @Route("/Actualites", name="home")
     */
    public function index(EventRepository $repository): Response
    {
        //on appelle la liste des tous les evenements
        $Event=$this->getDoctrine()->getRepository(Categorieevent::class)->findAll();
        if(isset($_GET['search'])) {
            $requestString = $_GET['search'];
            $events = $repository->findStudentByNsc($requestString);


            return $this->json(['retour' => $this->renderView('home/content.html.twig',
                ['Event' => $events])]);
        }
        return $this->render('home/index.html.twig', [
            'Event' => $Event
        ]);
    }

    /**
     * @Route("/Actualites/Events", name="events_Client")
     */
    public function listEvent(Request $request,PaginatorInterface $paginator)
    {
        //on appelle la liste des tous les evenements
        $allevent=$this->getDoctrine()->getRepository(Event::class)->findBy([],['dateDebEvent'=>'ASC']);
        $Categorieevent=$this->getDoctrine()->getRepository(Categorieevent::class)->findAll();

        $Event = $paginator->paginate(
            $allevent,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('home/Events.html.twig', [
            'Event' => $Event,
            'Categorieevent'=>$Categorieevent
        ]);

    }
    /**
     * @Route("/Actualites/Events/{idEvent}", name="events_Details")
     */
    public function detailsEvent(Event $Event): Response
    {
        $Categorieevent=$this->getDoctrine()->getRepository(Categorieevent::class)->findAll();

        return $this->render('home/details.html.twig', [
            'Event' => $Event,
            'Categorieevent'=>$Categorieevent

        ]);
    }
    /**
     * @Route("/Actualites/Events/{idEvent}/Commentaire", name="events_Details")
     */
    public function Comment(Event $Event): Response
    {
        $Categorieevent=$this->getDoctrine()->getRepository(Categorieevent::class)->findAll();

        return $this->render('home/details.html.twig', [
            'Event' => $Event,
            'Categorieevent'=>$Categorieevent

        ]);
    }





}
