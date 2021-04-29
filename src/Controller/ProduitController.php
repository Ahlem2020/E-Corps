<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategoriePrRepository;
use App\Repository\ProduitRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/Back/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator,ProduitRepository $ProduitRepository,CategoriePrRepository $CategoriePrRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM App\Entity\Produit p";
      //  $data = $this->getDoctrine()->getRepository(Produit::class)->findAll();
            $data = $em->createQuery($dql);
        $produits = $paginator->paginate(
            $data, // Requête contenant les données à paginer (Nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de produits par page
        );

        $ProduitsAll = $ProduitRepository->findAll();
        $CategoriesAll = $CategoriePrRepository->findAll();
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Gestion Hotel', 'Number per section'],
                ['Les Produits',     count($ProduitsAll)],
                ['Les Catégorie',     count($CategoriesAll)],

            ]
        );
        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('#e7515a');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('#805dca');
        $pieChart->getOptions()->setSlices([$pieSlice1, $pieSlice2]);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->setTitle(' Nombre de produit par rapport aux catégories');
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#e0e6ed');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->getBackgroundColor()->setFill("#000000");
        $pieChart->getOptions()->getLegend()->getTextStyle()->setColor("#e0e6ed");


        return $this->render('/Back/produit/index.html.twig', [
            'produits' => $produits,
            'pieChart' => $pieChart,
        ]);
    }
    /**
     * @Route("/reports", name="produit_reports", methods={"GET"})
     */
    public function Report(): Response
    {
        $data = $this->getDoctrine()->getRepository(Produit::class)->findBy([],
        ['Reports' => 'desc']);

        return $this->render('/Back/produit/report.html.twig', [
            'produits' => $data
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    //grace a ce service on peut recuperer les informations de notre requete
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        // parcourir la formulaire et extraire les infos
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // / @var UploadedFile $image
            $image = $form->get('Image')->getData();
            // this condition is needed because the 'Image' field is not required
            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                // security
                $fileName = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                // Move the file to the directory where Images are stored
                try{
                    $image->move(
                        $this->getParameter('imageproduit_directory'),$fileName);
                } catch (FileException $e)
                {
                }
                //updates the  property to store the Image file name
                $produit->setImage($fileName);
            }
           // It’s responsible for saving objects to, and fetching objects from, the database.
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            //executer la fonction et mettre a jour la base donnee
            $entityManager->flush();





            return $this->redirectToRoute('produit_index');
        }

        return $this->render('/Back/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET"},requirements={"id"="\d+"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('/Back/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('Image')->getData();


            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try{
                    $image->move(
                        $this->getParameter('imageproduit_directory'),$fileName);
                } catch (FileException $e)
                {

                }

                $produit->setImage($fileName);
            }



            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('/Back/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/traiter", name="produit_traiter", methods={"GET","POST"})
     */
    public function traiter(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('Image')->getData();


            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try{
                    $image->move(
                        $this->getParameter('imageproduit_directory'),$fileName);
                } catch (FileException $e)
                {

                }

                $produit->setImage($fileName);
            }



            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_reports');
        }

        return $this->render('/Back/produit/traitement.html.twig', [
            'produit' => $produit,
            'formreport' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
    /**
     * @Route("/{id}/deleteReport", name="produit_deleteReport", methods={"DELETE"})
     */
    public function deleteReport(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_reports');
    }



    /**
     * @route ("/pdf/{id}", name="pdf")
     */
    function generePDF(ProduitRepository $repository,$id)
    {
        // Configure Dompdf according to your needs

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        $pdfOptions->set('tempDir', '/home2/directory/public_html/directory/pdf-export/tmp');

        $produits = $repository->find($id);
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('pdf/pdf.html.twig', [
            'produit' => $produits
        ]);
        //$html .= '';
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Produit.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/pdflist", name="pdflist", methods={"GET"})
     */
    public function list(): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $Produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('pdf/pdfall.html.twig', [
            'produit' => $Produits,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListProduits.pdf", [
            "Attachment" => true
        ]);


    }



}
