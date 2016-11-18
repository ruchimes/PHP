<?php

class Apunte {
    
    private $id;
    private $tipo;      // de tipo Boolean (1=ingreso, 0=gasto)
    private $concepto;
    private $cantidad;
    private $fecha;
    private $user;
    
    
    function __construct($tipo=null, $concepto=null, $cantidad=null, $fecha=null, $user=null, $id=null) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->concepto = $concepto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->user = $user;
    }

    // Funcion que devuelve todos los apuntes del usuario con ID $id
    public static function getApuntesByUserID($bd, $id){
        $query = "SELECT * FROM `apunte` WHERE  `user` = :id";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Apunte");
        $select->execute(array(":id" => $id));
        $apuntesArray = $select->fetchAll();
        return $apuntesArray;
    }
    
    
    // Funcion que devuelve todos los apuntes de tipo $tipo 
    // entre 2 fechas determinadas ($fechaInicio y $fechaFin)
    public static function getApuntesByFechas($bd, $tipo, $fechaInicio, $fechaFin){
        $query = "SELECT * FROM `apunte` WHERE `tipo` = :tipo AND"
                . " `fecha` >= :fechaInicio AND  `fecha` <= :fechaFin ";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Apunte");
        $select->execute(array(":tipo" => $tipo, ":fechaInicio"=>$fechaInicio,  ":fechaFin"=>$fechaFin));
        $apuntesArray = $select->fetchAll();
        $apuntes = new Collection();
        foreach ($apuntesArray as $ap){
            $apuntes->add($ap);
        }
        return $apuntes;
    }
    
    // Funcion para persistir el objeto apunte a la base de datos
    // Se invoca esta funcion al crear un nuevo apunte
    public function persist($bd){
        
        $query = "INSERT INTO `apunte`(`tipo`, `concepto`, `cantidad`, `fecha`, `user`) "
                . "VALUES (:tipo,:concepto,:cantidad,:fecha,:user)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":tipo" => $this->tipo, ":concepto"=>  $this->concepto,
            ":cantidad"=>  $this->cantidad, ":fecha"=>  $this->fecha, ":user"=>  $this->user));
        if($check){
            $this->setId($bd->lastInsertId());
        }
        return $check;
    }
            
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

}
