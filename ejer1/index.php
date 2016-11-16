<?php
    
    $secretNumber = rand(1, 10);
    
    session_start();
    
    $_SESSION["number"] = $secretNumber;
    $_SESSION["attemps"] = 0;
    
    include './view.html';