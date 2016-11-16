<?php

class Team {
    private $id;
    private $name;
    
    function __construct($name=null, $id=null) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getById($bd, $id){
        $query = "SELECT * FROM `team` WHERE `id` = :id";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Team");
        $select->execute(array(":id"=>$id));
        $team = $select->fetch();
        return $team;
    }
    
    public function persist ( $bd ) {
        
        $query = "INSERT INTO `team`(`name`) VALUES (:name)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":name"=> $this->name));
        if($check){
            $this->setId($bd->lastInsertId());
        }
        return $check;
    }
            
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }
}
