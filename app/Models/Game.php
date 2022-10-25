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

        public function find( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `game` WHERE `id` = " . $id );
        $resultObject = $statement->fetchObject( "Game" );      
        return $resultObject;
        }

        public function findAll()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game`" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        public function findForHome()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game` LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        public function findTopPlayedGames()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT `name`, `played_parties` FROM `game` ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
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
            return $this->status;
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