<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Partie;
use App\Models\Player;


class PartieController extends CoreController
{

    public function add( )
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

    public function create()
    {
        $partieModel = new Partie;
        $playerList = Player::findAll();

        //RECUPERATION DES DONNEES ENVOYEES PAR LE FORMULAIRES POUR L'AJOUT D'UN NOUVEAU JEU DANS LA DATABASE
        if (isset($_POST) && !empty($_POST)) {
            $gameId = $_POST['gameId'];
   
            $playerNumber = $_POST['playerNumber'];

            $date = $_POST['partieDate'];
            

            //  Ajout du nouveau jeu à l'objet
            $partieModel->setGameId($gameId);
            $partieModel->setPlayersNumber($playerNumber);
            $partieModel->setDate($date);


            // Tout d'abord on récupère la liste des joueurs participants entrés dans le formulaire, et on les met dans un tableau
            $partiePlayers = [];
            for($i=1 ; $i <= $playerNumber ; $i++)
            {
              $partiePlayers[] = $_POST['joueur'.$i];
            }
            
            //Puis on compare ce tableau aux joueurs existants dans la BDD : si le joueur existe déjà, on stocke son id dans un nouveau tableau ($newPartiePlayers)
            $existingPartiePlayers=[];

            foreach($partiePlayers as $currentPartiePlayer)
            {
              foreach($playerList as $currentPlayer)
              {
                if($currentPlayer->getName() == $currentPartiePlayer)
                {
                  $existingPartiePlayers[$currentPlayer->getName()] = $currentPlayer->getId();
                }
              }             
            }
          
            //Puis on regarde quel joueurs qui a participé n'est pas déjà existants dans la BDD: pour ceux qui n'existent pas, on les stocke dans un nouveau tableau ($newPartiePlayers)
            // On procède en comparant tous les nom existants dans la BDD avec les noms de ceux ayant participé, et pour ceux qui n'y sont pas, on les ajoute au tableau.
            $playerNameList = Player::findAllNames();
            $newPartiePlayers=[];
            foreach($partiePlayers as $currentPartiePlayer)
            {
                if(!in_array($currentPartiePlayer, $playerNameList))
                {
                  $newPartiePlayers[]=$currentPartiePlayer;
                }
            }           

            // $partieModel->insert();

        }

        // // l'ID du produit demandé est dispo dans $params['partie_id']
        // $this->show( 'game/add', [

        //     ] );

    }

    public function list()
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