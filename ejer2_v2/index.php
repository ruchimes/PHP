<?php

    include './class/User.php';
    
    session_start();
    
    // Si hay una sesion abierta, el usuario ya esta logueado
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        
        if(isset($_POST["logOut"])){
            session_unset();
            session_destroy();
            $message = "Sesion cerrada, puedes hacer Log In de nuevo";
            include './views/logIn.php';
        }
        else if(isset ($_POST["modify"])){
            include './views/modify.php';
        }
        else if(isset ($_POST["procMod"])){
            $uss = $_POST["user"];
            $pass = $_POST["pass"];
            $email = $_POST["email"];
            $painter = $_POST["painter"];
            
            $user->modify($uss, $pass, $email, $painter);
            $user->persist();
            include './views/cuadro.php';
        }
        else if(isset ($_POST["delete"])){
            $user->delete();
            session_unset();
            session_destroy();
            $message = "Usuario borrado, puedes registrar otro usuario";
            include './views/logIn.php';
        }
        else{
            include './views/cuadro.php';
        }
    }
    else{
        if(isset($_POST["logIn"])){
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
        else if(isset($_POST["register"])){
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            $email = $_POST["email"];
            $painter = $_POST["painter"];
            
            $user = new User($user, $pass, $email, $painter);
            
            $user->persist();
            
            $message = "Usuario " . $user->getUser() . " correctamente registrado. Haz logIn";
            include './views/logIn.php';
        }
        else{
            include './views/logIn.php';
        }
    }