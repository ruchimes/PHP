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

    public function persist() {
        $conexion = BD::getConexion();
        if($this->id) {
            $query = "update users SET user = :user, pass = :pass, email = :email, painter = :painter WHERE id = :id";
            $update = $conexion->prepare($query);
            $checkProcess = $update->execute(array(":user" => $this->getUser(), ":pass" => $this->getPass(),
                ":email" => $this->getEmail(), ":painter" => $this->getPainter(), "id" => $this->getId()));
        } else {
            $insert = "Insert into users (user,pass,email,painter) values (:user, :pass, :email, :painter)";
            $insercion = $conexion->prepare($insert);
            $checkProcess = $insercion->execute(array(":user" => $this->getUser(), ":pass" => $this->getPass(),
                ":email" => $this->getEmail(), ":painter" => $this->getPainter()));
            if($checkProcess) {
                $this->setId($conexion->lastInsertId());
            }
        }
        return $checkProcess;
    }
    
    function delete(){
        $conexion = BD::getConexion();
        $query = "delete from users WHERE id = :id";
        $delete = $conexion->prepare($query);
        $checkProcess = $delete->execute(array("id" => $this->getId()));
    }
    
    public function __construct($user = null, $pass = null, $email = null, $painter = null, $id = null) {
        
        $this->id = $id;
        $this->user = $user;
        $this->pass = $pass;
        $this->email = $email;
        $this->painter = $painter;
    }
    
    function modify($user = null, $pass = null, $email = null, $painter = null) {
        $this->user = $user;
        $this->pass = $pass;
        $this->email = $email;
        $this->painter = $painter;
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
