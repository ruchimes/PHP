<?php

include_once 'BD.php';
include_once 'League.php';


class User {
    private $id;
    private $userName;
    private $pass;
    private $league;
    
    function __construct($id=null, $userName=null, $pass=null, $league=null) {
        $this->id = $id;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->league = $league;
    }
    
    public static function getByCredentials($userName,$pass){
        
            $conexion = BD::getConexion();
            $query= "SELECT * FROM `user` WHERE `userName` = :userName and `pass` = :pass ";
            $select = $conexion->prepare($query);
            $select->setFetchMode(PDO::FETCH_CLASS |  PDO::FETCH_PROPS_LATE, "User");
            $select->execute(array(":userName"=>$userName, ":pass"=>$pass));
            $user = $select->fetch();

            if($user){
                $league = League::getByUserId(BD::getConexion(), $user->getId());
                $user->setLeague($league);
            }
            return $user;

    }
    
    public function persist(){
        $conection = BD::getConexion();
        if($this->id){
            // TODO
        }
        else{
            $query = "INSERT INTO `user`(`userName`, `pass`) VALUES (:userName,:pass)";
            $insert= $conection->prepare($query);
            $check = $insert->execute(array(":userName"=>$this->userName,":pass"=>  $this->pass));
            if($check){
                $this->setId($conection->lastInsertId());
            }
        }
        return $check;
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getUserName() {
        return $this->userName;
    }

    function getPass() {
        return $this->pass;
    }

    function getLeague() {
        return $this->league;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setLeague($league) {
        $this->league = $league;
    }
}
