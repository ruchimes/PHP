<?php

include_once 'BD.php';
include_once 'Book.php';
include_once 'Collection.php';

class User {
    
    private $id;
    private $userName;
    private $pass;
    private $books;
    
    function __construct($id=null, $userName=null, $pass=null, $books=null) {
        $this->id = $id;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->books = $books;
    }
    
    public static function getByCredentials($bd,$userName,$pass){
        
        $query = "SELECT * FROM `user` WHERE `userName` = :userName AND `pass` = :pass ";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $select->execute(array(":userName"=>$userName, ":pass"=>$pass));
        $user = $select->fetch();
        
        if($user){
            $books = Book::getByUserID($bd, $user->getId());
            $user->setBooks($books);
        }
        return $user;
    }
    
    public function persist($bd){
        $query = "INSERT INTO `user`(`userName`, `pass`) VALUES (:userName,:pass)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":userName"=>  $this->userName, ":pass"=>  $this->pass));
        return $check;
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

    function getBooks() {
        return $this->books;
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

    function setBooks($books) {
        $this->books = $books;
    }



}
