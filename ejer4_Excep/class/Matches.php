<?php

class Matches {
    private $id;
    private $day;
    private $team1;
    private $team2;
    private $goals1;
    private $goals2;
    
    function __construct($day=null, $team1=null, $team2=null, $goals1=null, $goals2=null, $id=null) {
        $this->id = $id;
        $this->day = $day;
        $this->team1 = $team1;
        $this->team2 = $team2;
        $this->goals1 = $goals1;
        $this->goals2 = $goals2;
    }

    function persist($bd){
        if($this->id){
            $query = "UPDATE `matches` SET `goals1`= :goals1 ,`goals2`= :goals2  WHERE `id`= :id";
            $update = $bd->prepare($query);
            $check = $update->execute(array(":goals1" => $this->goals1, ":goals2" => $this->goals2, ":id" => $this->id));
        }
        else{
            $query = "INSERT INTO `matches`(`day`, `team1`, `team2`) VALUES (:day, :team1, :team2)";
            $insert = $bd->prepare($query);
            $check = $insert->execute(array(":day" => $this->day, ":team1" => $this->team1->getId(), ":team2"=> $this->team2->getId()));
            if($check){
                $this->setId($bd->lastInsertId());
            }
        }
        return $check;
    }
    
    static function getByDayId($bd, $id, &$teams){
        $query = "SELECT * FROM `matches` WHERE `day` = :id";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Matches");
        $select->execute(array(":id"=>$id));
        $matchesArray = $select->fetchAll();
        $matches = new Collection();
        foreach ($matchesArray as $mat){
            if(!$teams->getByProperty("id",$mat->getTeam1())){
                $team1 = Team::getById($bd,$mat->getTeam1());
                $teams->add($team1);
            }else{
                $team1 = $teams->getByProperty("id",$mat->getTeam1());
            }
            if(!$teams->getByProperty("id",$mat->getTeam2())){
                $team2 = Team::getById($bd,$mat->getTeam2());
                $teams->add($team2);
            }else{
                $team2 = $teams->getByProperty("id",$mat->getTeam2());
            }
            $mat->setTeam1($team1);
            $mat->setTeam2($team2);
            $matches->add($mat);
        }
        return $matches;
    }
    
    function getId() {
        return $this->id;
    }

    function getDay() {
        return $this->day;
    }

    function getTeam1() {
        return $this->team1;
    }

    function getTeam2() {
        return $this->team2;
    }

    function getGoals1() {
        return $this->goals1;
    }

    function getGoals2() {
        return $this->goals2;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDay($day) {
        $this->day = $day;
    }

    function setTeam1($team1) {
        $this->team1 = $team1;
    }

    function setTeam2($team2) {
        $this->team2 = $team2;
    }

    function setGoals1($goals1) {
        $this->goals1 = $goals1;
    }

    function setGoals2($goals2) {
        $this->goals2 = $goals2;
    }
}
