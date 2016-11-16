<?php
    
    include_once './Game.php';

    $game = new Game();
    
    session_start();
    
    $_SESSION["game"] = $game;
    
    include './view.html';