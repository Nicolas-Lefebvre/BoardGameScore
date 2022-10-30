<?php

require_once __DIR__ . "/../Models/Partie.php";
require_once __DIR__ . "/CoreController.php";

class PartieController extends CoreController
{

    public function add( $params )
    {

      $playersList=Player::findAll();

      $gamesList=Game::findAll();

    //   $partieModel = new Partie();
    //   $partieObject = $partieModel->find( $params['partie_id'] );



      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'partie/add', [
        "playersList"   => $playersList,
        "gamesList"   => $gamesList,
        ] );
    }

    public function list( $params )
    {

      // $playerModel = new Player();
      // $playersList=$playerModel->findAll();

      // $gameModel = new Game();
      // $gamesList=$gameModel->findAll();


      $partiesList = Partie::findAllByDate();

      $gamesList = Game::findAll();

      $playersList = Player::findAll();


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
      $this->show( 'partie/list', [
        "partiesList"        => $partiesList,
        "orderedGamesList"   => $orderedGamesList,
        "orderedPlayersList" => $orderedPlayersList,
        ] );
    }















}