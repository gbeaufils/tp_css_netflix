<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('index/accueil.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
      * @Route("/catalogue", name="catalogue")
      */
     public function catalogue()
     {
         return $this->render('index/catalogue.html.twig', [
             'controller_name' => 'IndexController',
         ]);
     }
}
