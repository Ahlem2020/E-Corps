<?php

namespace App\Controller;

use App\Entity\Commentairee;
use App\Entity\Comments;
use App\Form\CommentaireeType;
use App\Form\CommentsType;
use App\Form\ParticipanteType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Entity\Categorieevent;
use App\Entity\Participante;

/**
 * Class HomeController
 * @Route ("/",name="")
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/Actualites", name="home")
     */
    public function index(EventRepository $repository): Response
    {
        //on appelle la liste des tous les evenements
        $Event = $this->getDoctrine()->getRepository(Categorieevent::class)->findAll();
        if(isset($_GET['search'])) {
            $requestString = $_GET['search'];
            $Event = $repository->findStudentByNsc($requestString);


            return $this->json(['retour' => $this->renderView('event/content.html.twig', ['Event' => $Event])]);
        }
        return $this->render('home/index.html.twig', [
            'Event' => $Event
        ]);
    }

    /**
     * @Route("/Actualites/Events", name="events_Client")
     */
    public function listEvent(Request $request, PaginatorInterface $paginator)
    {
        //on appelle la liste des tous les evenements
        $allevent = $this->getDoctrine()->getRepository(Event::class)->findBy([], ['dateDebEvent' => 'ASC']);
        $Categorieevent = $this->getDoctrine()->getRepository(Categorieevent::class)->findAll();

        $Event = $paginator->paginate(
            $allevent,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('home/Events.html.twig', [
            'Event' => $Event,
            'Categorieevent' => $Categorieevent
        ]);

    }

    /**
     * @Route("/Actualites/Events/{idEvent}", name="events_Details")
     */
    public function detailsEvent(Event $Event, Request $request): Response
    {
        $E = $this->getDoctrine()->getRepository(Event::class)->find($Event);
        $Categorieevent = $this->getDoctrine()->getRepository(Categorieevent::class)->findAll();
        //partie partcipation

        $Participant = new Participante();
        $ParticipantForm = $this->createForm(ParticipanteType::class, $Participant);
        $ParticipantForm->handleRequest($request);
        if ($ParticipantForm->isSubmitted()) {


            $ent = $this->getDoctrine()->getManager();
            $Participant->setComptelogin("20202");
            $Participant->setIdEvent($E);
            $E->countParticipant();
            $ent->flush();
            $this->addFlash('message', 'vous participez à notre événement avec succès'); // Permet un message flash de renvoi
            return $this->redirectToRoute("events_Details", ['idEvent' => $Event->getIdEvent()]);

        }

        //partie commentaire
        $comment = new Comments();
        $CommentForm = $this->createForm(CommentsType::class, $comment);
        $CommentForm->handleRequest($request);
        //traitement de formulaire
        if ($CommentForm->isSubmitted() && $CommentForm->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setEvents($E);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('message', 'votre commentaire a bien été envoyé');
            return $this->redirectToRoute("events_Details", ['idEvent' => $Event->getIdEvent()]);

        }


        return $this->render('home/details.html.twig', [
            'Event' => $Event,
            'Categorieevent' => $Categorieevent,
            'CommentForm' => $CommentForm->createView(),
            'ParticipantForm' => $ParticipantForm->createView(),
        ]);
    }


}
