<?php

    include_once 'Collection.php';
    include_once 'Apunte.php';

class User {
    
    private $id;
    private $userName;
    private $pass;
    private $apuntes;  // de tipo Collection
    
    function __construct($id=null, $userName=null, $pass=null, $apuntes=null) {
        $this->id = $id;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->apuntes = $apuntes;
    }
    
    // Funcion que devuelve el usuario con nombre de usuario $userName
    // y con contraseña $pass
    // Si no coinciden las credenciales se devuelve un objeto vacio, 
    // que significa que no se le puede dar acceso a la aplicacion
    public static function getUserByCredentials($bd, $userName, $pass){
        
        $query = "SELECT * FROM `user` WHERE `userName` = :userName AND `pass` = :pass ";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $select->execute(array(":userName" => $userName, ":pass"=>$pass));
        $user = $select->fetch();
        if($user){
            $apuntes = new Collection();
            $apuntesArray = Apunte::getApuntesByUserID($bd,$user->getID());
            foreach ($apuntesArray as $ap) {
                $apuntes->add($ap);
            }
            $user->setApuntes($apuntes);
        }
        return $user;
    }

    // Funcion para persistir el objeto user a la base de datos
    // Se invoca esta funcion al registrar un nuevo usuario
    public function persist($bd){
        
        $query = "INSERT INTO `user`(`userName`, `pass`) VALUES (:userName, :pass)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":userName" => $this->userName, ":pass"=>  $this->pass));
        if($check){
            $this->setId($bd->lastInsertId());
        }
        return $check;
    }
    
    // Funcion que obtiene el saldo actual recorriendo todos los apuntes 
    // y sumando la cantidad del apunte si es de tipo ingreso (tipo = 1)
    // o restando la cantidad del apunte si es de tipo gasto (tipo = 0)
    public function saldoActual(){
        $saldo = 0;
        while($apunte = $this->getApuntes()->iterate()){
            if($apunte->getTipo()){
                $saldo += $apunte->getCantidad();
            }
            else{
                $saldo -= $apunte->getCantidad();
            }
        }
        return $saldo;
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

    function getApuntes() {
        return $this->apuntes;
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

    function setApuntes($apuntes) {
        $this->apuntes = $apuntes;
    }


    
}
