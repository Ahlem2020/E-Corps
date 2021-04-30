<?php

namespace App\Controller;

use App\Entity\Regimes;
use App\Form\RegimesType;
use App\Form\SearchRegimeType;
use App\Repository\MyClassRepository2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Snappy\Pdf;



class SafeController extends AbstractController
{
    /**
     * @Route("/back/MJ/safe", name="safe")
     */
    public function viewRegimeAction(Request $request,MyClassRepository2 $repo)
    {
        $regime = $repo->findBy(['titre' => 'mots'], ['titre' => 'asc'], 5);
        $form = $this->createForm(SearchRegimeType::class);
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $regime= $repo->search(
                $search->get('mots')->getData()
            );
            return $this->render('back/MJ/safe/afficher_Regime.html.twig', ['reg' => $regime, 'form' => $form->createView()]);
        }

        $rep = $this->getDoctrine()->getRepository(Regimes::class)->findAll();
        return $this->render('back/MJ/safe/afficher_Regime.html.twig', ['reg' => $rep, 'form' => $form->createView()]);
    }
    /**
     * @Route("/back/MJ/Safe_sup/{id}", name="Safe_sup")
     */
    public function deleteregimesAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $rep = $em->getRepository(Regimes::class)->find($id);
        $em->remove($rep);
        $em->flush();
        $this->addFlash('message',"Regime supprimé");
        return $this->redirectToRoute('safe');

    }

    /**
     * @Route("/back/MJ/Safe_gest", name="Safe_gest")
     */
    public function index(MailerInterface $mailer,Request $request): Response
    {
        $Regime = new Regimes();
        $form = $this->createForm(RegimesType::class, $Regime);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($Regime);
                $em->flush();
                $email = (new Email())
                    ->from('secondaryhp@gmail.com')
                    ->to('secondaryhp@gmail.com')
                    ->subject('regimes')
                    ->text("regimes Ajouté ! ❤");
                $mailer->send($email);
                return $this->redirectToRoute('safe');
            }
            else
            {
                $this->addFlash('error', 'Remarque les mots interdits sont (mot1,mot2...)!');

            }
        }

        return $this->render('back/MJ/Safe_gest/ajouter_Regime.html.twig', [
            'post_form' => $form->createView()

        ]);
    }
    /**
     * @Route("/back/MJ/Safe_mod/{id}", name="Safe_mod")
     */
    public function editRegimeAction(Request $request, $id, MailerInterface $mailer)
    {

        $rep = $this->getDoctrine()->getRepository(Regimes::class)->find($id);
        $rep->setTitre($rep->getTitre());
        $rep->setDescription($rep->getDescription());
        $rep->setImgUml($rep->getImgUml());
        $form = $this->createFormBuilder($rep)
            ->add('titre',TextType::class, ['attr' =>['placeholder'=>'enter title here']])
            ->add('description',TextareaType::class)
            ->add('imguml',TextType::class)
            ->add('Modifier',SubmitType::class)

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $titre = $form['titre']->getData();
                $desc = $form['description']->getData();
                $ImgUml = $form['imguml']->getData();
                $em = $this->getDoctrine()->getManager();
                $rep = $em->getRepository(Regimes::class)->find($id);
                $rep->setTitre($titre);
                $rep->setDescription($desc);
                $rep->setImgUml($ImgUml);
                $em->flush();
                $email = (new Email())
                    ->from('secondaryhp@gmail.com')
                    ->to('secondaryhp@gmail.com')
                    ->subject('regimes')
                    ->text("regimes Modifié ! ❤");
                $mailer->send($email);
                $this->addFlash('mod', 'regimes Modifié!');
                return $this->redirectToRoute('safe');
            }
            else
            {
                $this->addFlash('error_mod', 'Remarque les mots interdits sont (mot1,mot2...)!');

            }
        }
        return $this->render('back/MJ/Safe_mod/modifier_Regime.html.twig', [
            'post_form' => $form->createView()

        ]);

    }
    /**
     * @Route("/front/MJ/client2", name="client2")
     */
    public function view2RegimeAction()
    {
        $reg = $this->getDoctrine()->getRepository(Regimes::class)->findAll();
        return $this->render('front/MJ/client2/afficher_Regime.html.twig', ['reg' => $reg]);
    }
    /**
     * @Route("/back/MJ/back", name="back")
     */
    public function view3regimesAction()
    {
        return $this->render('back/MJ/back/Back.html.twig');
    }
    /**
     * @Route("/back/MJ/PDF", name="pdf")
     */
    public function PDFAction(Request $request)
    {
        $reg = $this->getDoctrine()->getRepository(Regimes::class)->findAll();
        $form = $this->createForm(RegimesType::class);
        $form->handleRequest($request);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('back/MJ/safe/afficher_Regime.html.twig', [
                'reg' => $reg,'form' => $form->createView()
            ]
        );

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Regimespdf.pdf", [
            "Attachment" => true
        ]);

        return $this->redirectToRoute('safe');
    }

}
