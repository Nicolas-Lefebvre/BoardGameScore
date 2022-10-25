<?php

class player
{
    //==============================
    // Propriétés
    //==============================

    protected $id;
    protected $name;
    protected $genre;
    protected $won_parties;



    // Foreign Keys
    //none

    //==============================
    // Méthodes
    //==============================

    public function find($id)
    {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query("SELECT * FROM `game` WHERE `id` = " . $id);
        $resultObject = $statement->fetchObject("Player");
        return $resultObject;
    }

    public function findAll()
    {
        $pdo       = Database::getPDO();
        $statement = $pdo->query("SELECT * FROM `player`");
        $results   = $statement->fetchAll(PDO::FETCH_CLASS, "Player");
        return $results;
    }

    public function findBestPlayers()
    {
        $pdo       = Database::getPDO();
        $statement = $pdo->query("SELECT * FROM `player` ORDER BY `won_parties` DESC LIMIT 10");
        $results   = $statement->fetchAll(PDO::FETCH_CLASS, "Player");
        return $results;
    }



    // Requete SDL qui link tous les tables
    //    SELECT * FROM `partie` INNER JOIN   `player` ON `partie`.`winner`=`player`.`id` INNER JOIN   `game` ON `partie`.`game_id`=`game`.`id`

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
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of wonParties
     */ 
    public function getWonParties()
    {
        return $this->won_parties;
    }

    /**
     * Set the value of wonParties
     *
     * @return  self
     */ 
    public function setWonParties($won_parties)
    {
        $this->won_parties = $won_parties;

        return $this;
    }
}