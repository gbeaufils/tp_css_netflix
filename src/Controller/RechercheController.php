<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Service\Omdb;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     * @param Request $request
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function recherche(Request $request)
    {
        $omdbApi = new Omdb();
        if (isset($request->request->get('recherche')['RechercheData'])) {

            $titre = $request->request->get('recherche')['RechercheData'];
            $resultRecherche = $omdbApi->getByTitle($titre);

            return $this->render('index/catalogue.html.twig', [
                'resultRecherche' => $resultRecherche,
            ]);
        }
    }

    /**
     * Affichage de la searchBar
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBar()
    {
        $recherche = new Recherche();
        $form = $this->createForm(RechercheType::class, $recherche);

        return $this->render('recherche/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
