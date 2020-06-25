<?php

namespace App\Controller;

use App\Service\Omdb;
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
      * @Route("/catalogue/{currentPage}", name="catalogue", defaults={"currentPage"=1})
      */
     public function catalogue(int $currentPage = 1)
     {
         $omdbApi = new Omdb();
         $listeFilms = [];
         $listeFilms['films'] = [];

         // Fake data : Id de films pour l'affichage dans catalogue
         $dataFilmsFavoris = ['tt0903747', 'tt1375666', 'tt0944947','tt0121955','tt4574334', 'tt2306299', 'tt5727474',
             'tt2527336', 'tt4052886', 'tt1386697'];

         $dataFilmsFavoris2 = ['tt5180504', 'tt0108778', 'tt1632701', 'tt4154796',
             'tt2935510', 'tt4532826', 'tt1365519', 'tt2873282', 'tt4972582', 'tt0803096'];

         $fakeDataPage = $currentPage == 1 ? $dataFilmsFavoris : $dataFilmsFavoris2;

         $listeFilms['response'] = 'True';
         $listeFilms['nbPages'] = 2;
         $listeFilms['currentPage'] = $currentPage;

         foreach ($fakeDataPage as $idFilm)
         {
             $dataOmdbApi = $omdbApi->getById($idFilm);

             array_push($listeFilms['films'], $dataOmdbApi);
         }

         return $this->render('index/catalogue.html.twig', [
             'controller_name' => 'IndexController',
             'resultRecherche' => $listeFilms
         ]);
     }

     /**
      * @Route("/recherche/{titleSearch}/{currentPage}", name="recherche",defaults={"currentPage" = 1, "titleSearch" = ""})
      * @param Request $request
      */
     public function recherche(Request $request, int $currentPage = 1, string $titleSearch = '')
     {
         $omdbApi = new Omdb();
         if (isset($request->request->get('recherche')['RechercheData'])) {

             $titre = $request->request->get('recherche')['RechercheData'];


         } else {
            $titre = $titleSearch;
         }
             $resultRecherche = $omdbApi->getByTitle($titre, $currentPage);

        return $this->render('index/catalogue.html.twig', [
                     'resultRecherche' => $resultRecherche
             ]);
     }

     /**
       * @Route("/details/{idFilm}", name="details",defaults={"idFilm" = ""})
       * @param Request $request
       */
      public function details(string $idFilm)
      {
          $omdbApi = new Omdb();
          $detailsFilm = $omdbApi->getById($idFilm);
         return $this->render('index/detailFilm.html.twig', [
                      'detailsFilm' => $detailsFilm
              ]);
      }
}
