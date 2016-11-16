<?php

    include_once './class/User.php';
    include_once './class/League.php';
    include_once './class/BD.php';

    session_start();
    
    if(isset($_SESSION["user"])){
        
        $user = $_SESSION["user"];
        
        if(isset($_POST["logOut"])){
            session_unset();
            session_destroy();
            include './view/LogIn.php';
        }
        else if(isset($_POST["newLeague"])){
            $name = $_POST["name"];
            $teams = $_POST["teams"];
            
            $league = new League($name, $user->getId());
            try{
                $league->persist(BD::getConexion());
                $teams = $league->newLeague(BD::getConexion(),$teams);

                $league->setTeams($teams);
                
                $_SESSION["user"]->setLeague($league);

                include './view/menu.php';
            } catch (PDOException $ex) {
                $message = "Ha habido un problema en el acceso a BBDD ";
                include './view/LogIn.php';
            }
        }
        else if(isset($_POST["editDay"])){
            $day = $_POST["day"];
            $day = $user->getLeague()->getDays()->getByProperty("id", $day);
            $_SESSION["day"] = $day->getId();
            include './view/editDay.php';
        }
        else if(isset($_POST["sendDay"])){
            $matches = $_POST["match"];
            $day = $user->getLeague()->getDays()->getByProperty("id", $_SESSION["day"]);
            $matchesEnter = new Collection();
            try{
                foreach ($matches as $id => $match){
                    $mat = $day->getMatches()->getByProperty("id", $id);
                    $mat->setGoals1($match[1]);
                    $mat->setGoals2($match[2]);
                    $mat->persist(BD::getConexion());
                    $matchesEnter->add($mat);
                }
                $_SESSION["user"]->getLeague()->getDays()->getByProperty("id", $_SESSION["day"])->setmatches($matchesEnter);
                $_SESSION["user"]->getLeague()->getDays()->getByProperty("id", $_SESSION["day"])->setModified(true);
                $_SESSION["user"]->getLeague()->getDays()->getByProperty("id", $_SESSION["day"])->persist(BD::getConexion());

                $message = "Resultados de la jornada introducidos";
                include './view/menu.php';
            }  catch (PDOException $ex) {
                $message = "Ha habido un problema en el acceso a BBDD ";
                include './view/LogIn.php';
            }
        }
        else if(isset($_POST["classif"])){
            $classification = $user->getLeague()->classification();
            include './view/classification.php';
        }
        else if(!$user->getLeague()){
            include './view/newLeague.php';
        }
        else{
            include './view/menu.php';
        }
    }
    else{
        if(isset($_POST["procLogIn"])){
            $userName = $_POST["userName"];
            $pass = md5($_POST["pass"]);
            
            try{
                $user = User::getByCredentials($userName, $pass);
                if($user){
                    $_SESSION["user"] = $user;

                    if(!$user->getLeague()){
                        include './view/newLeague.php';
                    }
                    else{
                        include './view/menu.php';
                    }
                }
                else{
                    $message = "No coinciden las credenciales proporcionadas. Prueba de nuevo";
                    include './view/LogIn.php';
                }
            } catch (PDOException $ex) {
                $message = "Ha habido un problema en el acceso a BBDD ";
                include './view/LogIn.php';
            }
        }
        else if(isset($_POST["register"])){
            include './view/register.php';
        }
        else if(isset($_POST["procRegis"])){
            $userName = $_POST["userName"];
            $pass = md5($_POST["pass"]);
            
            $user = new User();
            $user->setUserName($userName);
            $user->setPass($pass);
            try{
                if($user->persist()){
                    $message = "Usuario registrado correctamente";
                    include './view/LogIn.php';
                }
                else{
                    $message = "No se ha podido registrar. Prueba de nuevo";
                    include './view/register.php';
                }
            } catch (PDOException $ex) {
                $message = "Ha habido un problema en el acceso a BBDD ";
                include './view/LogIn.php';
            }
            
        }
        else{
            include './view/logIn.php';
        }
    }
    //comment