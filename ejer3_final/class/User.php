<?php

require_once 'BD.php';
require_once 'Game.php';
require_once 'Collection.php';

class User {
    private $id;
    private $userName;
    private $pass;
    private $currentGame;
    private $games;
    
    function __construct($id=null, $userName=null, $pass=null, $game=null, $currentGame=null ) {
        $this->id = $id;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->currentGame = $currentGame;
        $this->games = $game;
    }

    
    public static function getByCredentials($userName,$pass){
        $conexion = BD::getConexion();
        $query= "SELECT * FROM `user` WHERE `userName` = :userName and `pass` = :pass ";
        $select = $conexion->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS |  PDO::FETCH_PROPS_LATE, "User");
        $select->execute(array(":userName"=>$userName, ":pass"=>$pass));
        $user = $select->fetch();
        
        if($user){
            $user->games = new Collection();
            $games = Game::getByUserId($user->getId());
            foreach ($games as $game){
                $user->setGames($game);
            }
        }
        return $user;
    }
    
    public function persist(){
        $conection = BD::getConexion();

        $query = "INSERT INTO `user`(`userName`, `pass`) VALUES (:userName,:pass)";
        $insert= $conection->prepare($query);
        $check = $insert->execute(array(":userName"=>$this->userName,":pass"=>  $this->pass));
        if($check){
            $this->setId($conection->lastInsertId());
        }

        return $check;
    }
    
    function update(){
        $this->games = new Collection();
        $games = Game::getByUserId($this->id);
        foreach ($games as $game){
            $this->setGames($game);
        }
    }
            
    function getId() {
        return $this->id;
    }

    function getUserName() {
        return $this->userName;
    }

    function getPass() {
        return $this->pass;
    }

    function getCurrentGame() {
        return $this->currentGame;
    }

    function getGames() {
        return $this->games;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setCurrentGame($currentGame) {
        $this->currentGame = $currentGame;
    }

    function setGames($game) {
        $this->games->add($game);       
    }
}
