<?php

// require_once __DIR__ . "/../Models/Game.php";
// require_once __DIR__ . "/../Models/Player.php";
require_once __DIR__ . "/../Models/Partie.php";

class SideController
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

      $gameModel = new Game();
      $homeGames=$gameModel->findForHome();


      // Pour vérifier les variables disponibles dans les vues
      d( get_defined_vars() );

      // Avant d'inclure la page, on commence par le header
      require_once __DIR__ . '/../views/partials/header.tpl.php';

      // La page demandée
      require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';

      // Ensuite, on oublie pas le footer
      require_once __DIR__ . '/../views/partials/footer.tpl.php';
    }

    


    public function newPartie( $params )
    {

      $playerModel = new Player();
      $playersList=$playerModel->findAll();

      $gameModel = new Game();
      $gamesList=$gameModel->findAll();

    //   $partieModel = new Partie();
    //   $partieObject = $partieModel->find( $params['partie_id'] );



      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'ajout-partie', [
        "playersList"   => $playersList,
        "gamesList"   => $gamesList,
        ] );
    }

    public function allParties( $params )
    {

      // $playerModel = new Player();
      // $playersList=$playerModel->findAll();

      // $gameModel = new Game();
      // $gamesList=$gameModel->findAll();

      $partieModel = new Partie();
      $partiesList = $partieModel->findAllByDate();

      $gameModel = new Game();
      $gamesList = $gameModel->findAll();

      $playerModel = new Player();
      $playersList = $playerModel->findAll();


      // ci-dessous, on fait correspondre l'index de chaque jeu avec son id afin de faire remonter ces infos facilement dans la vue.
      $orderedGamesList = [];
      foreach($gamesList as $currentgame)
      {
        $orderedGamesList[$currentgame->getId()] = $currentgame ;
      }

      // ci-dessous, on fait correspondre l'index de chaque joueur avec son id afin de faire remonter ces infos facilement dans la vue.
      $orderedPlayersList = [];
      foreach($playersList as $currentPlayer)
      {
        $orderedPlayersList[$currentPlayer->getId()] = $currentPlayer ;
      }

      // // ci-dessous, on fait correspondre l'index de chaque joueur avec son id afin de faire remonter ces infos facilement dans la vue.
      // $orderedPlayersList = [];
      // foreach($playersList as $currentPlayer)
      // {
      //   $orderedPlayersList[$currentPlayer->getId()] = $currentPlayer ;
      // }

      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'listing-parties', [
        "partiesList"        => $partiesList,
        "orderedGamesList"   => $orderedGamesList,
        "orderedPlayersList" => $orderedPlayersList,
        ] );
    }


    public function Game( $params )
    {

      $gameModel = new Game();
      $gamesList=$gameModel->findAll();


      //RECUPERATION DES DONNEES ENVOYEES PAR LE FORMULAIRES POUR L'AJOUT D'UN NOUVEAU JEU DANS LA DATABASE
      if (isset($_GET['gameName'])) {
        $gameNameToAdd = $_GET['gameName'];
        // d($gameNameToAdd);

        $gameEditorToAdd = $_GET['gameEditor'];
        // d($gameEditorToAdd);
        $minPlayerNumberToAdd = $_GET['minPlayerNumber'];
        // d($minPlayerNumberToAdd);
        $maxPlayerNumberToAdd = $_GET['maxPlayerNumber'];
        // d($maxPlayerNumberToAdd);

        // on fait correspondre le winType choisi avec son nom exact dans la DB
        if($_GET['scoreType'] === "Le score le plus élevé gagne"){$scoreTypeToAdd = "highest_score";}
        elseif($_GET['scoreType'] === "Le score le plus bas gagne"){$scoreTypeToAdd = "lowest_score";}
        elseif($_GET['scoreType'] === "Pas de score"){$scoreTypeToAdd = "no_score";}
        // d($scoreTypeToAdd);
        
        if(isset($_GET['isCoopGame'])){$isCoopGameToAdd =1;} else{$isCoopGameToAdd =0;}
        // d($isCoopGameToAdd);
        if(isset($_GET['isTeamGame'])){$isTeamGameToAdd =1;} else{$isTeamGameToAdd =0;}
        // d($isTeamGameToAdd);

        //  Ajout du nouveau jeu à la DB
        $gameModel = new Game();
        $gameModel->addNewGame($gameNameToAdd, $gameEditorToAdd, null, 0, $minPlayerNumberToAdd, $maxPlayerNumberToAdd, $scoreTypeToAdd, $isCoopGameToAdd, $isTeamGameToAdd );
        
      }


      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'ajout-jeu', [
        "gamesList"   => $gamesList,
        ] );
    }


    public function allGames( $params )
    {

      $gameModel = new Game();
      $gamesList=$gameModel->findAll();

      $partieModel = new Partie();
      $partiesList = $partieModel->findAll();

      $playerModel = new Player();
      $playersList = $playerModel->findAll();

      // $gameModel = new Game();
      // $gamesOject=$gameModel->find($id);

      $orderedgamesList = [];
      foreach($gamesList as $currentGame)
      {
        $orderedgamesList[$currentGame->getId()] = $currentGame ;
      }

      $orderedpartiesList = [];
      foreach($partiesList as $currentPartie)
      {
        $orderedpartiesList[$currentPartie->getId()] = $currentPartie ;
      }

      $orderedplayersList = [];
      foreach($playersList as $currentPlayer)
      {
        $orderedplayersList[$currentPlayer->getId()] = $currentPlayer ;
      }
      
      function findChampionByGame($partiesList, $gameId){

        // on identifie pour chaque jeu, toutes les parties avec l'id du gagnant
        $allGamesWinners=[];

        foreach ($partiesList as $partie) {
          if($partie->getGameId() == $gameId){
            $allGamesWinners[] = $partie->getWinner();
          }
        }
        // d($allGamesWinners);

        // Ensuite on repère quel id de gagnant est le plus fréquent, en le placer en premiere valeur du tableau
        $freq=array_count_values($allGamesWinners);
        // d($freq);

        arsort($freq, SORT_NUMERIC);

        // Si une valeur id est renvoyée (si au moins une partie a été jouée pour ce jeu, il y aura un gagnant, sinon cela ne renvoit pas de valeur)
        // On renvoit le nom du joueur associé à cet id
        if(isset(array_values($freq)[0])):

          $playerModel = new Player();
          $playerObject = $playerModel->find(array_values($freq)[0]);
          return $playerObject->getName();
          // return array_values($freq)[0];

        // Sinon, on écrit qu'aucune partie n'a été jouée.
        else: 
          return '<i class="text-muted">aucune partie jouée</i>';
        endif;

        // d($freq);
      } 

      function findRecordByGame($partiesList, $gameId){

        // on identifie pour chaque jeu, toutes les parties avec l'id du gagnant
        $allGamesRecords=[];

        foreach ($partiesList as $partie) {
          if($partie->getGameId() == $gameId){
            $allGamesRecords[] = $partie->getWinningScore();
          }
        }
        // d($allGamesRecords);

        // Ensuite on repère quel score est le plus élevé, en le placer en premiere valeur du tableau
        if(!empty($allGamesRecords)){
        $maxScore=max($allGamesRecords);
        // d($maxScore);
        }

        // Si une valeur est renvoyée 
        // On renvoit ce score
        if(!empty($allGamesRecords) && ($maxScore) !== null):
            return $maxScore;
          // Sinon, on écrit qu'aucune partie n'a été jouée.
          else: 
            return '<i class="text-muted">aucune partie jouée</i>';
          endif;
        // d($freq);
      } 



      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'listing-games', [
        "gamesList"          => $gamesList,
        "orderedpartiesList" => $orderedpartiesList,
        "partiesList"        => $partiesList,
        ] );
    }

    
}