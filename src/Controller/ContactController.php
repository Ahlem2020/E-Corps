<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact" ,methods={"GET","POST"})
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $message = (new \Swift_Message('Un Produit a été signalé !'))
                ->setFrom($contact['Email'])
                ->setTo('mehyar.saidi@esprit.tn')
                ->setBody(
                    $this->renderView('Email/contact.html.twig', compact('contact')),
                    'text/html'
                )
            ;
        $mailer->send($message);
            return $this->redirectToRoute('produitFront_index');

        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),

        ]);
    }
}
