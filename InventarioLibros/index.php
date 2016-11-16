<?php
    
    include_once './class/BD.php';
    include_once './class/Collection.php';
    include_once './class/User.php';
    include_once './class/Book.php';

session_start();

if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    
    if(isset($_POST["logOut"])){
        session_unset();
        session_destroy();
        include './views/logIn.php';
    }
    else if(isset ($_POST["newBook"])){
        include './views/newBook.php';
    }
    else if(isset ($_POST["procNew"])){
        $bookPOST = $_POST["book"];
        
        $book = new Book($bookPOST["name"], $bookPOST["edit"], $bookPOST["writter"], 
                $bookPOST["year"], $bookPOST["pag"], $user->getId());
        $book->persist(BD::getConexion());
        
        $_SESSION["user"]->getBooks()->add($book);
        
        include './views/menu.php';
    }
    else if(isset ($_POST["del"])){
        
    }
    else if(isset ($_POST["xml"])){
        
    }
    else{
        include './views/menu.php';
    }
}
else{
    if(isset($_POST["logIn"])){
        $userName = $_POST["userName"];
        $pass = $_POST["pass"];
        $user = User::getByCredentials(BD::getConexion(), $userName, $pass);
        if($user){
            $_SESSION["user"] = $user;
            include './views/menu.php';
        }
        else{
            include './views/logIn.php';
        }
    }
    else if(isset($_POST["register"])){
        include './views/register.php';
    }
    else if(isset($_POST["procRegis"])){
        $userName = $_POST["userName"];
        $pass = $_POST["pass"];
        $user = new User();
        $user->setUserName($userName);
        $user->setPass($pass);
        if($user->persist(BD::getConexion())){
            include './views/logIn.php';
        }
        else{
            include './views/register.php';
        }
    }
    else{
        include './views/logIn.php';
    }
}