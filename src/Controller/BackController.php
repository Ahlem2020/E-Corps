<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/Back")
 */
class BackController extends AbstractController
{
    /**
     * @Route("/", name="Back_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {

        return $this->render('Back/index.html.twig');
    }


}