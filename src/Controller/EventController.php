<?php

namespace App\Controller;

use App\Entity\Categorieevent;
use App\Entity\Event;
use Swift_Message;
use Swift_Mailer;
use App\Form\EventType;
use Knp\Component\Pager\PaginatorInterface;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {
        $allevent = $this->getDoctrine()->getRepository(Event::class)->findBy([], ['dateDebEvent' => 'ASC']);

        if(isset($_GET['search'])) {
            $requestString = $_GET['search'];
            $Event = $repository->findStudentByNsc($requestString);


            return $this->json(['retour' => $this->renderView('event/content.html.twig', ['Event' => $Event])]);
        }
        $Event = $paginator->paginate(
            $allevent,
            $request->query->getInt('page', 1),
            1
        );


        return $this->render('event/index.html.twig', [
            'Event' => $Event,
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request,Swift_Mailer $mailer): Response
    {
        $event = new Event();
        $category = new Categorieevent();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        $images = $form->get('imageevent')->getData();

        if ($form->isSubmitted() && $form->isValid()) {

            /*-------------------Début Image--------------------*/
            $file=$event->getImageevent();
            $Filename = uniqid().'.'.$images->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $Filename);
            }
            catch(FileException $e){
            }
            /*-------------------Fin Image--------------------*/
            $entityManager = $this->getDoctrine()->getManager();
            $event->setImageevent($Filename);
            $entityManager->persist($event);
            $entityManager->flush();

    
            $message = (new Swift_Message('Nouveau Evénement ajouter '))
                // On attribue l'expéditeur
                ->setFrom('no-reply@SecnodLife.com')
                // On attribue le destinataire
                ->setTo('ahlem.benfradj@esprit.tn')
                ->setBody(
                    $this->renderView(
                        'Event/notificationmail.html.twig', compact('event')
                    ),
                    'text/html'
                )
            ;
            //envoie le msg
            $mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvent}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{idEvent}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvent}", name="event_delete", methods={"POST"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getIdEvent(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
