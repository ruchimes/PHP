<?php

    require_once './class/Partida.php';
    
    session_start();
    
    if(isset($_SESSION["game"])){
        $partida = $_SESSION["game"];
        
        $letter = $_POST["letter"];
        
        $partida->checkLetter($letter);
        
        if($partida->checkWin()){
            include './views/win.php';
            session_unset();
            session_destroy();
        }
        else{
            include './views/game.php';
        }
        
    }
    else{
        $partida = new Partida();
        $_SESSION["game"] = $partida;
        include './views/game.php';
    }
    
   