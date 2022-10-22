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


        //==============================
        // Getters & Setters 
        //==============================

        /**
         * Get the value of description
         */ 
        public function id()
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
    }