<?php

    if(!isset($_POST["send"])){
        header("location: http://localhost:8000");
    }
    
    include_once './Game.php';
    
    session_start();
    
    $game = $_SESSION["game"];
    
    $number = (int)$_POST["number"];    
    
    $game->increaseAttemps();
    
    if($game->checkNumber($number)<0){
        $_SESSION["message"] = "El numero a adivinar es menor del introducido";
        include './view.html';
    }
    else if($game->checkNumber($number)>0){
        $_SESSION["message"] = "El numero a adivinar es mayor del introducido";
        include './view.html';
    }
    else{
        include './win.php';
        session_unset();
        session_destroy();
    }