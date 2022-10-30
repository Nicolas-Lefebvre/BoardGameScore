<?php

    class Game
    {
        //==============================
        // Propriétés
        //==============================
        
        protected $id;
        protected $name;
        protected $editor;
        protected $picture;
        protected $played_parties;
        protected $win_type;


        // Foreign Keys
        //none

        //==============================
        // Méthodes 
        //==============================

        public static function find( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `game` WHERE `id` = " . $id );
        $resultObject = $statement->fetchObject( "Game" );      
        return $resultObject;
        }

        public static function findAll()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game`" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        public static function findForHome()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game` ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        public static function findTopPlayedGames()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT `name`, `played_parties` FROM `game` ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        // public function findGamesRecord()
        // {
        // $pdo       = Database::getPDO();
        // $statement = $pdo->query( "SELECT * FROM `partie` INNER JOIN ORDER BY `played_parties` DESC LIMIT 10" );
        // $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        // return $results;
        // }

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
              return "aucune partie jouée";
            endif;
    
            // d($freq);
    
          } 



        public function addNewGame($name, $editor=null, $picture=null, $played_parties=0, $min_players=1, $max_players, $win_type='highest_score', $cooperative=0, $team_play=0 )
        {
        $pdo       = Database::getPDO();
        $pdo->query( "INSERT INTO `game` (`name`, `editor`, `min_players`,`max_players`, `win_type`, `cooperative`, `team_play`) 
        VALUES ('$name', '$editor', $min_players, $max_players, '$win_type', $cooperative, $team_play)" );
        }


        //==============================
        // Getters & Setters 
        //==============================

        /**
         * Get the value of description
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
        return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
        $this->name = $name;
        return $this;
        }

            /**
         * Get the value of status
         */ 
        public function getEditor()
        {
            return $this->editor;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setEditor($editor)
        {
            $this->editor = $editor;

            return $this;
        }


        /**
         * Get the value of picture
         */ 
        public function getPicture()
        {
            return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */ 
        public function setPicture($picture)
        {
            $this->picture = $picture;

            return $this;
        }


        /**
         * Get the value of playedParties
         */ 
        public function getPlayedParties()
        {
                return $this->played_parties;
        }

        /**
         * Set the value of playedParties
         *
         * @return  self
         */ 
        public function setPlayedParties($played_parties)
        {
                $this->played_parties = $played_parties;

                return $this;
        }

        /**
         * Get the value of win_type
         */ 
        public function getWinType()
        {
                return $this->win_type;
        }

        /**
         * Set the value of win_type
         *
         * @return  self
         */ 
        public function setWinType($win_type)
        {
                $this->win_type = $win_type;

                return $this;
        }
    }