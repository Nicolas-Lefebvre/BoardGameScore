<?php

require_once __DIR__ . "/../Models/Game.php";
require_once __DIR__ . "/../Models/Player.php";

class Controller
{

    public function show( $viewName, $viewData = [] )
    {
      global $router;

      // Permet de créer des variables automatiquement pour chaque clé du tableau $viewData
      // https://www.php.net/manual/fr/function.extract.php
      extract( $viewData );

      // A défaut de savoir faire autrement (et mieux), on va récupérer ici les données
      // communes a toutes nos pages, EN PLUS des données transmises par viewData
      $gameModel    = new Game();
      $gameList     = $gameModel->findAll();


      // Pour vérifier les variables disponibles dans les vues
      d( get_defined_vars() );

      // Avant d'inclure la page, on commence par le header
      require_once __DIR__ . '/../views/partials/header.tpl.php';

      // La page demandée
      require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';

      // Ensuite, on oublie pas le footer
      require_once __DIR__ . '/../views/partials/footer.tpl.php';
    }

    public function home()
    {
      // Ici pour les catégories, plusieurs solutions
      // 1. Créer une méthode findForHome() sur notre Model Category
      // Pour récupérer celles sur la page d'accueil uniquelent

      $gameModel = new Game();
      $homeGames=$gameModel->findForHome();

      $gameModel = new Game();
      $topPlayedGames=$gameModel->findForHome();

      $playerModel = new Player();
      $bestPlayers=$playerModel->findBestPlayers();

      // 2. Réutiliser le tableau de toutes les catégories qu'on a dans 
      // la navigation pour n'afficher ici que ceux avec un home_order > 1
      // En revanche cette solution nous amenerai a faire un "traitement" de la données
      // directement dans la Vue. Ce n'est pas son rôle et donc on préfèrera la solution 1.

      $this->show( 'home', [ 
        "homeGames"     => $homeGames,
        "topPlayedGames"=> $topPlayedGames,
        "bestPlayers"   => $bestPlayers,
      ] );
    }


    public function game( $params )
    {
      $gameModel = new Game();
      $gameObject = $gameModel->find( $params['game_id'] );

      // l'ID du produit demandé est dispo dans $params['game_id']
      $this->show( 'game.view', [
        "currentObject" => $gameObject,
        ] );
    }


    
}