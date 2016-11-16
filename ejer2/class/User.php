<?php

include_once 'BD.php';

class User {
    private $id;
    private $user;
    private $pass;
    private $email;
    private $painter;
    
    
    public static function getByCredential($user, $pass) {
        $conexion = BD::getConexion();
        $consulta = "SELECT * FROM users WHERE user = :user AND pass = :pass";
        $select = $conexion->prepare($consulta);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $select->execute(array(":user" => $user, ":pass" => $pass));
        $usuario = $select->fetch();
        return $usuario;
    }
    
    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

    function getEmail() {
        return $this->email;
    }

    function getPainter() {
        return $this->painter;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPainter($painter) {
        $this->painter = $painter;
    }


    
}
