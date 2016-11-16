<?php

    include './class/User.php';
    
    session_start();
    
    
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        if(isset($_POST["logOut"])){
            session_unset();
            session_destroy();
            include './views/logIn.php';
        }
        else{
            include './views/cuadro.php';
        }
    }
    else{
        if(isset($_POST["logIn"])){
            //TODO logica logIn
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            $user = User::getByCredential($user, $pass);
            if($user){
                $_SESSION["user"] = $user;
                include './views/cuadro.php';
            }
            else{
                $message = "No coinciden las credenciales, prueba de nuevo";
                include './views/logIn.php';
            }
        }
        else{
            include './views/logIn.php';
        }
    }