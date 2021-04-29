<?php

namespace App\Controller;

use App\Entity\CategoriePr;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategoriePrRepository;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/produitFront")
 */
class ProduitFrontController extends AbstractController
{
    /**
     * @Route("/", name="produitFront_index", methods={"GET"})
     */
    public function index(CategoriePrRepository $categoriePrRepository,Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $produits = $paginator->paginate(
            $data, // Requête contenant les données à paginer (Nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de produits par page
        );
        return $this->render('/Front/produitFront/index.html.twig', [
            'produits' => $produits,
            'categories' => $categoriePrRepository->findAll(),
        ]);
    }




    /**
     * @Route("/{id}", name="produitFront_show", methods={"GET","POST"},requirements={"id"="\d+"})
     */
    public function show(Produit $produit, CategoriePrRepository $categoriePrRepository,Request $request): Response
    {

        $defaultData = [];
        $form_Report = $this->createFormBuilder($defaultData)
            ->add('Signaler ce produit', SubmitType::class)
            ->getForm();
        $form_Report->handleRequest($request);

        
        if ($form_Report->isSubmitted() && $form_Report->isValid()) {
            $produit->setReports($produit->getReports()+1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('/Front/produitFront/show.html.twig', [
            'produit' => $produit,
            'categories' => $categoriePrRepository->findAll(),
            'form5' => $form_Report->createView(),
        ]);
    }

    /**
     * @Route("/ProduitCat/{id}", name="ProduitCat", methods={"GET","POST"})
     */
    public function indexPr($id, CategoriePr $sous_cats ,CategoriePrRepository $categoriePrRepository, PaginatorInterface $paginator,Request $request)
    {
        $cats= $categoriePrRepository->find(["id" => $id]); // recupere la categorie
        $data= $cats->getProduits(); // tu auras tout les produits de cette categorie
        $produits = $paginator->paginate(
            $data, // Requête contenant les données à paginer (Nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6
        );// Nombre de produits par page
        return $this->render('/Front/produitFront/index.html.twig', [
            'produits' => $produits,
            'categories' => $categoriePrRepository->findAll(),
        ]);
    }


    /**
     * @Route("/searchProduitx ", name="searchProduitx")
     */
    public function searchProduitx(Request $request,NormalizerInterface $Normalizer) //akel page edhika
    {
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $requestString=$request->get('searchValue');
        $Produits= $repository->findProduitByName($requestString);
        $jsonContent = $Normalizer->normalize($Produits, 'json',['groups'=>'post:read']);// objet base = objet json
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }


}
