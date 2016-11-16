<?php

class Book {
    
    private $id;
    private $name;
    private $edit;
    private $writter;
    private $year;
    private $pages;
    private $user;
    
    
    function __construct($name=null, $edit=null, $writter=null, $year=null, $pages=null, $user=null, $id=null) {
        $this->id = $id;
        $this->name = $name;
        $this->edit = $edit;
        $this->writter = $writter;
        $this->year = $year;
        $this->pages = $pages;
        $this->user = $user;
    }

    static function  getByUserID($bd,$user){
        $query = "SELECT * FROM `book` WHERE `user` = :user";
        $select = $bd->prepare($query);
        $select->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Book");
        $select->execute(array(":user"=>$user));
        $booksArray = $select->fetchAll();
        
        $books = new Collection();
        foreach ($booksArray as $book) {
            $books->add($book);
        }
        return $books;
    }
        
    public function persist($bd){
        $query = "INSERT INTO `book`(`name`, `edit`, `writter`, `year`, `pages`, `user`) "
                . "VALUES (:name,:edit,:writter,:year,:pages,:user)";
        $insert = $bd->prepare($query);
        $check = $insert->execute(array(":name"=>  $this->name, ":edit"=>  $this->edit,
            ":writter"=>  $this->writter,":year"=>  $this->year,":pages"=>  $this->pages,":user"=>  $this->user));
        return $check;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEdit() {
        return $this->edit;
    }

    function getWritter() {
        return $this->writter;
    }

    function getYear() {
        return $this->year;
    }

    function getPages() {
        return $this->pages;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEdit($edit) {
        $this->edit = $edit;
    }

    function setWritter($writter) {
        $this->writter = $writter;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setPages($pages) {
        $this->pages = $pages;
    }

    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }


    
}
