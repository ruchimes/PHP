<?php

class Day {
    
    private $id;
    private $date;
    private $league;
    private $modified;
    private $matches;
    
    function __construct($date=null, $league=null, $matches=null, $modified=null, $id=null) {
        $this->id = $id;
        $this->date = $date;
        $this->league = $league;
        $this->modified = $modified;
        $this->matches = $matches;
    }

    function persist($bd){
        try{
            if($this->id){
                $query = "UPDATE `day` SET  `modified`= true WHERE `id`= :id";
                $update = $bd->prepare($query);
                $check = $update->execute(array(":id"=> $this->id));
            }
            else{
                $query = "INSERT INTO `day`(`date`, `league`) VALUES (:date, :league)";
                $insert = $bd->prepare($query);
                $check = $insert->execute(array(":date"=> $this->date, ":league"=> $this->league));
                if($check){
                    $this->setId($bd->lastInsertId());
                }
            }
        } catch (PDOException $ex) {
             echo "Ha ocurrido un error ".$ex->getMessage()."<br />";
        }
        return $check;
    }
    
    static function getByLeagueId($bd,$id){
        $query = "SELECT * FROM `day` WHERE `league` = :id";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Day");
        $select->execute(array(":id"=>$id));
        $daysArray = $select->fetchAll();
        $days = new Collection();
        foreach ($daysArray as $day){
            $matches = Matches::getByDayId($bd, $day->getId());
            $day->setMatches($matches);
            $days->add($day);
        }
        return $days;
    }
    
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getLeague() {
        return $this->league;
    }

    function getMatches() {
        return $this->matches;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setLeague($league) {
        $this->league = $league;
    }

    function setMatches($matches) {
        $this->matches = $matches;
    }

    function getModified() {
        return $this->modified;
    }

    function setModified($modified) {
        $this->modified = $modified;
    }

}
