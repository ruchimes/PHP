<?php

    if(!isset($_POST["send"])){
        header("location: http://localhost:8000");
    }
    
    session_start();
    
    $secretNumber = (int)$_SESSION["number"];
    $_SESSION["attemps"]++;
    
    $number = (int)$_POST["number"];
    
    if($secretNumber<$number){
        $_SESSION["message"] = "El numero a adivinar es menor del introducido";
        include './view.html';
    }
    else if($secretNumber>$number){
        $_SESSION["message"] = "El numero a adivinar es mayor del introducido";
        include './view.html';
    }
    else{
        include './win.php';
        session_unset();
        session_destroy();
    }