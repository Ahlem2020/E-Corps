<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="Front_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {

        return $this->render('/Front/index.html.twig');
    }


}