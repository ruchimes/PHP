<?php

include_once 'AlmacenPalabras.php';
include_once 'Attempt.php';
include_once 'Collection.php';

class Game {
    protected $id;
    protected $word;
    protected $progress;
    protected $end;
    protected $numAttempts;
    protected $letters;
    protected $moves;
    protected $user;
    
    
    function __construct($id=null, $word=null, $progress=null, $end=null, $numAttempts=null, $letters=null, $moves=null, $user=null) {
        $this->id = $id;
        $this->word = $word;
        $this->progress = $progress;
        $this->end = $end;
        $this->numAttempts = $numAttempts;
        $this->letters = $letters;
        $this->moves = $moves;
        $this->user = $user;
    }
    
    public static function getByUserId($user){
        $connection = BD::getConexion();
        $query = "SELECT * FROM `game` WHERE `user` = :user";
        $select = $connection->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Game");
        $select->execute(array(":user"=>$user));
        $games = $select->fetchAll();
        foreach ($games as $game){
            $game->letters = [];
            $game->moves = new Collection();
            $attempts = Attempt::getByGameId($game->getId());
            foreach ($attempts as $attempt){
                $game->setMoves($attempt);
                $game->setLetters($attempt->getLetter());
            }
        }
        return $games;
    }
    
    public static function getByGameId($id){
        $connection = BD::getConexion();
        $query = "SELECT * FROM `game` WHERE `id` = :id";
        $select = $connection->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Game");
        $select->execute(array(":id"=>$id));
        $game = $select->fetch();
        
        $game->letters = [];
        $game->moves = new Collection();
        $attempts = Attempt::getByGameId($game->getId());
        foreach ($attempts as $attempt){
            $game->setMoves($attempt);
            $game->setLetters($attempt->getLetter());
        }
        return $game;
    }
            
    public function persist() {
        
        $connection = BD::getConexion();
        
        if($this->id){
            $query = "UPDATE `game` SET `progress`=:progress,`end`=:end,`numAttempts`=:numAttempts WHERE `id` =:id";
            $update = $connection->prepare($query);
            $update->execute(array(":progress"=>$this->progress, ":end"=>$this->end, ":numAttempts"=>$this->numAttempts, ":id"=>$this->id));
        }
        else{
            $query = "INSERT INTO `game`(`word`, `progress`, `end`, `numAttempts`, `user`) "
                    . "VALUES (:word,:progress,:end,:numAttempts,:user)";
            $insert = $connection->prepare($query);
            $check = $insert->execute(array(":word"=>$this->word, ":progress"=>$this->progress, 
                                   ":end"=>$this->end, ":numAttempts"=>$this->numAttempts, ":user"=>$this->user));
            if($check){
                $this->setId($connection->lastInsertId());
            }
        }
    }
    
    public function start($user) {
        $almacen = AlmacenPalabras::getInstance();
        $this->word = $almacen->getPalabraAleatoria();
        $this->progress = str_pad("_",  strlen($this->word), "_");
        $this->end = false;
        $this->numAttempts = 0;
        $this->letters = [];
        $this->moves = new Collection();
        $this->user = $user;
        
        $this->persist();
    }
    
    public function checkLetter($letter) {
        
        if(in_array($letter, $this->letters) || $letter==""){
            return 0;
        }
        
        $arr_word = str_split($this->word);
        $arr_progress = str_split($this->progress);
        
        foreach ($arr_word as $key => $let) {
            if($letter === $let){
                $arr_progress[$key] = $letter;
            }
        }
        
        $this->numAttempts++;
        $this->progress = implode("", $arr_progress);
        
        $attempt = new Attempt($letter, $this->progress, $this->id);
        $attempt->persist();
        $this->moves->add($attempt);
        $this->setLetters($letter);
        
        $this->persist();
    }
    
    function checkWin(){
        $win = $this->word == $this->progress;
        if($win){
            $this->end = true;
            $this->persist();
        }
        return $win;
    }
    
    function getId() {
        return $this->id;
    }

    function getWord() {
        return $this->word;
    }

    function getProgress() {
        return $this->progress;
    }

    function getEnd() {
        return $this->end;
    }

    function getNumattempts() {
        return $this->numAttempts;
    }

    function getLetters() {
        return $this->letters;
    }

    function getPlays() {
        return $this->moves;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setWord($word) {
        $this->word = $word;
    }

    function setProgress($progress) {
        $this->progress = $progress;
    }

    function setEnd($end) {
        $this->end = $end;
    }

    function setNumattempts($numAttempts) {
        $this->numAttempts = $numAttempts;
    }

    function setLetters($letters) {
        array_push($this->letters, $letters);
    }

    function setPlays($moves) {
        $this->moves = $moves;
    }
    
    function getMoves() {
        return $this->moves;
    }

    function getUser() {
        return $this->user;
    }

    function setMoves($move) {
        $this->moves->add($move);
    }

    function setUser($user) {
        $this->user = $user;
    }

}
