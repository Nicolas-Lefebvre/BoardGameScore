<?php

    class Partie
    {
        //==============================
        // Propriétés
        //==============================
        
        protected $id;
        protected $game_id;
        protected $date;
        protected $players_number;
        protected $winner;
        protected $player1_id;
        protected $player2_id;
        protected $player3_id;
        protected $player4_id;
        protected $player5_id;
        protected $player6_id;
        protected $winning_score;



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
        $statement = $pdo->query( "SELECT * FROM `partie`" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Partie" );
        return $results;
        }

        public static function findAllByDate()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `partie` ORDER BY `date` DESC" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Partie" );
        return $results;
        }

        public static function findPartieWinningScore( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT `winning_score` FROM `partie` WHERE `id` = ".$id);
        $resultObject = $statement->fetchObject( "Partie" );      
        return $resultObject;
        }

        public static function findPartieLowestScore( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `partie` WHERE `id` = " . $id ." ORDER BY `player%_score` ASC LIMIT 1");
        $resultObject = $statement->fetchObject( "Partie" );      
        return $resultObject;
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
         * Get the value of game_id
         */ 
        public function getGameId()
        {
                return $this->game_id;
        }

        /**
         * Set the value of game_id
         *
         * @return  self
         */ 
        public function setGameId($game_id)
        {
                $this->game_id = $game_id;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of players_number
         */ 
        public function getPlayersNumber()
        {
                return $this->players_number;
        }

        /**
         * Set the value of players_number
         *
         * @return  self
         */ 
        public function setPlayersNumber($players_number)
        {
                $this->players_number = $players_number;

                return $this;
        }

        /**
         * Get the value of winner
         */ 
        public function getWinner()
        {
                return $this->winner;
        }

        /**
         * Set the value of winner
         *
         * @return  self
         */ 
        public function setWinner($winner)
        {
                $this->winner = $winner;

                return $this;
        }

        /**
         * Get the value of player1_id
         */ 
        public function getPlayer1Id()
        {
                return $this->player1_id;
        }

        /**
         * Set the value of player1_id
         *
         * @return  self
         */ 
        public function setPlayer1Id($player1_id)
        {
                $this->player1_id = $player1_id;

                return $this;
        }

        /**
         * Get the value of player2_id
         */ 
        public function getPlayer2Id()
        {
                return $this->player2_id;
        }

        /**
         * Set the value of player2_id
         *
         * @return  self
         */ 
        public function setPlayer2Id($player2_id)
        {
                $this->player2_id = $player2_id;

                return $this;
        }

        /**
         * Get the value of player3_id
         */ 
        public function getPlayer3Id()
        {
                return $this->player3_id;
        }

        /**
         * Set the value of player3_id
         *
         * @return  self
         */ 
        public function setPlayer3Id($player3_id)
        {
                $this->player3_id = $player3_id;

                return $this;
        }

        /**
         * Get the value of player4_id
         */ 
        public function getPlayer4Id()
        {
                return $this->player4_id;
        }

        /**
         * Set the value of player4_id
         *
         * @return  self
         */ 
        public function setPlayer4Id($player4_id)
        {
                $this->player4_id = $player4_id;

                return $this;
        }

        /**
         * Get the value of player5_id
         */ 
        public function getPlayer5Id()
        {
                return $this->player5_id;
        }

        /**
         * Set the value of player5_id
         *
         * @return  self
         */ 
        public function setPlayer5Id($player5_id)
        {
                $this->player5_id = $player5_id;

                return $this;
        }

        /**
         * Get the value of player6_id
         */ 
        public function getPlayer6Id()
        {
                return $this->player6_id;
        }

        /**
         * Set the value of player6_id
         *
         * @return  self
         */ 
        public function setPlayer6Id($player6_id)
        {
                $this->player6_id = $player6_id;

                return $this;
        }

        /**
         * Get the value of winningScore
         */ 
        public function getWinningScore()
        {
                return $this->winning_score;
        }

        /**
         * Set the value of winningScore
         *
         * @return  self
         */ 
        public function setWinningScore($winning_score)
        {
                $this->winningScore = $winning_score;

                return $this;
        }
    }