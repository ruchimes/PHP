<?php

include_once 'BD.php';

class Attempt {
    protected $id;
    protected $letter;
    protected $finalWord;
    protected $game;
    
    
    function __construct($letter=null, $finalWord=null, $game=null) {
        $this->letter = $letter;
        $this->finalWord = $finalWord;
        $this->game = $game;
    }

    public static function getByGameId($gameId){
        $connection = BD::getConexion();
        $query = "SELECT * FROM `attempt` WHERE `game` = :gameId ";
        $select = $connection->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Attempt");
        $select->execute(array(":gameId"=>$gameId));
        $attempts = $select->fetchAll(); 
        return $attempts;
    }
    
    public function persist(){
        $connection = BD::getConexion();
        $query = "INSERT INTO `attempt`(`letter`, `finalWord`, `game`) "
                . "VALUES (:letter,:finalWord,:game)";
        $insert = $connection->prepare($query);
        $check = $insert->execute(array(":letter"=>$this->letter, ":finalWord"=>$this->finalWord, ":game"=>$this->game));
        if($check){
            $this->setId($connection->lastInsertId());
        }
    }
    
    function getId() {
        return $this->id;
    }

    function getLetter() {
        return $this->letter;
    }

    function getFinalWord() {
        return $this->finalWord;
    }

    function getGame() {
        return $this->game;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLetter($letter) {
        $this->letter = $letter;
    }

    function setFinalWord($finalWord) {
        $this->finalWord = $finalWord;
    }

    function setGame($game) {
        $this->game = $game;
    }


    
    
    
    
}
