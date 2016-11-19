<?php

include_once 'Collection.php';
include_once 'Day.php';
include_once 'Matches.php';
include_once 'Team.php';
include_once 'BD.php';

class League {
    
    private $id;
    private $name;
    private $days;
    private $teams;
    private $user;
    
    function __construct($name=null, $user=null, $id=null, $days=null, $teams=null) {
        $this->id = $id;
        $this->name = $name;
        $this->days = $days;
        $this->user = $user;
        $this->teams = $teams;
    }
    
        // Genera la liga entera
        // equipos, partidos, jornadas
    public function newLeague($bd, $teams){
        
        $teamsArray = explode(",", str_replace(" ", "", $teams));

        $teams = new Collection();
        
        foreach ($teamsArray as $team) {
            $team = new Team($team);
            $team->persist($bd);
            $teams->add($team);
        }
        
        $league = $this->roundRobin($teamsArray);

        $days = new Collection();

        foreach ($league as $number => $dayArray) {
            
            $date = date("Y-m-d", mktime(0, 0, 0, 11, 2+(7*$number), 2014));  
            
            $day = new Day($date, $this->id);
            
            $day->persist($bd);
            
            $matches = new Collection();
            
            foreach ($dayArray as $match) {
                
                if($match["local"] != "extra" && $match["visitante"] != "extra"){

                    $match = new Matches($day->getId(), $teams->getByProperty("name", $match["local"]),
                            $teams->getByProperty("name", $match["visitante"]),0,0);
                    $match->persist($bd);
                    $matches->add($match);
                }
            }
            $day->setMatches($matches);
            $days->add($day);
        }
        $this->setDays($days);
        
        return $teams;
    }
    
    function roundRobin($equipos) {

        if (count($equipos) % 2 != 0) {
            array_push($equipos, "extra");
        }
        for ($i = 0; $i < count($equipos) - 1; $i++) {
            $locales = array_slice($equipos, 0, (count($equipos) / 2));
            $visitantes = array_reverse(array_slice($equipos, (count($equipos) / 2)));

            for ($j = 0; $j < count($visitantes); $j++) {
                $liga[$i][$j]['local'] = $locales[$j];
                $liga[$i][$j]['visitante'] = $visitantes[$j];
            }
            $equipoBase = array_shift($equipos);
            array_unshift($equipos, array_pop($equipos));
            array_unshift($equipos, $equipoBase);
        }
        foreach ($liga as $jornada) {
            $jornadaVuelta = [];
            foreach ($jornada as $partido) {
                $partidoVuelta['local'] = $partido['visitante'];
                $partidoVuelta['visitante'] = $partido['local'];
                $jornadaVuelta[] = $partidoVuelta;
            }
            array_push($liga, $jornadaVuelta);
        }
        return $liga;
    }
        
    public function classification(){
        
        $classification = []; 
        
        while($day = $this->days->iterate()){
           
            $class = $day->classification();
            
            foreach ($class as $name => $value) {
                foreach ($value as $key => $val) {
                    if(isset($classification[$name][$key])){
                        $classification[$name][$key] += $val;
                    }
                    else{
                        $classification[$name][$key] = $val;
                    }
                }
            }  
        } 

        $pt = array_column($classification, "pt");
        $gf = array_column($classification, "gf");
        $ga = array_column($classification, "ga");
        
        array_multisort($pt, SORT_DESC, $gf, SORT_DESC, $ga, SORT_DESC, $classification);

        return $classification;
    }
    
    public static function getByUserId ($bd, $id){
        $query = "SELECT * FROM `league` WHERE `user` = :id";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "League");
        $select->execute(array(":id"=>$id));
        $league = $select->fetch();
        if($league){
            $teams = new Collection();
            $days = Day::getByLeagueId($bd, $league->getId(), $teams);
            $league->setDays($days);
            
            $league->setTeams($teams);
        }
        return $league;
    }    
    
    public function persist($bd){
        $query="INSERT INTO `league`(`name`, `user`) VALUES (:name, :user)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":name"=> $this->name, ":user"=> $this->user));
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

    function getDays() {
        return $this->days;
    }

    function getUser() {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDays($days) {
        $this->days = $days;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function getTeams() {
        return $this->teams;
    }

    function setTeams($teams) {
        $this->teams = $teams;
    }


}
