<?php

    require_once 'class/Game.php';
    require_once 'class/User.php';
    
    session_start();
    
    if(isset($_SESSION["user"])){
        
        $user = $_SESSION["user"];
        
        if(isset($_POST["logOut"])){
            session_unset();
            session_destroy();
            include './views/logIn.php';
        }
        else{
            if(isset($_POST["new"])){
                $game = new Game();
                $game->start($_SESSION["user"]->getId());
                $_SESSION["user"]->setGames($game);
                $_SESSION["user"]->setCurrentGame($game); // Usar currentGame para mostrar mas visible la ultima partida del usuario
                include './views/game.php';
            }
            else{
                if(isset($_POST["retrieve"])){
                    if(!isset($_POST["game"])){
                        include './views/menu.php';
                    }
                    else{
                        $gameId = $_POST["game"];
                        $game = Game::getByGameId($gameId);
                        if($game->getEnd()){
                            $message= "Esta partida esta finalizada, no puedes seguir jugandola";
                            include './views/menu.php';
                        }
                        else{                            
                            $_SESSION["user"]->setCurrentGame($game);
                            include './views/game.php';
                        }
                    }
                }
                else{
                    if(isset($_POST["xml"])){
                        if(!isset($_POST["game"])){
                            include './views/menu.php';
                        }
                        else{
                            $gameId = $_POST["game"];
                            $game = Game::getByGameId($gameId);
                            include './views/summary.php';
                        }
                    }
                    else{
                        if(isset($_POST["send"])){
                            
                            $letter = $_POST["letter"];

                            $_SESSION["user"]->getCurrentGame()->checkLetter($letter);

                            if($_SESSION["user"]->getCurrentGame()->checkWin()){
                                $_SESSION["user"]->update();
                                include './views/win.php';
                            }
                            else{
                                include './views/game.php';
                            }
                        }
                        else{
                            if(isset($_POST["stop"])){
                                $_SESSION["user"]->update();
                                include './views/menu.php';
                            }
                            else{
                                include './views/menu.php';
                            }
                        }
                    }
                }
            }
        }
    }
    else{
        if(isset($_POST["procLogIn"])){
            $userName = $_POST["userName"];
            $pass = md5($_POST["pass"]);
            
            $user = User::getByCredentials($userName, $pass);
            
            if($user){
                $_SESSION["user"] = $user;
                include './views/menu.php';
            }
            else{
                $message = "Error en las credenciales introducidas. Prueba de nuevo";
                include './views/logIn.php';
            }
        }
        else{
            if(isset($_POST["register"])){
                include './views/register.php';
            }
            else{
                if(isset($_POST["procRegis"])){
                    $name = $_POST["userName"];
                    $pass = md5($_POST["pass"]);
                    
                    $user = new User();
                    $user->setUserName($name);
                    $user->setPass($pass);
                    
                    if($user->persist()){
                        $message = "Usuario correctamente registrado";
                        include './views/logIn.php';
                    }
                    else{
                        $message = "No se ha podido registrar el usuario.Quiza ya este registrado";
                        include './views/register.php';
                    }
                }
                else{
                    include './views/logIn.php';
                }
            }
        }
    }
    