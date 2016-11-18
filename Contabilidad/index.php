<?php
     
    include_once './Class/BD.php';
    include_once './Class/User.php';

    session_start();

    // Si el usuario tiene una sesion valida
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        
        // Si el usuario quiere hacer LogOut destruyo la sesion y le redirijo al login
        if(isset($_POST["logOut"])){
            session_unset();
            session_destroy();
            include './Views/logIn.php';
        }
        
        // Le envio al usuario la vista con el formulario para que guarde un nuevo apunte
        else if(isset($_POST["nuevo"])){
            include './Views/nuevo.php';
        }
        
        // Proceso el nuevo apunte
        else if(isset($_POST["procNuevo"])){
            $apuntePost = $_POST["apunte"];    
            
            //Si la cantidad del apunte no es un numero no lo guardo, 
            //le redirijo a la vista para que lo vuelva a introducur de nuevo
            if(is_numeric($apuntePost["cantidad"])){
                
                // Creo un nuevo apunte con los datos del apunte que el usuario ha enviado
                $apunte = new Apunte($apuntePost["tipo"], $apuntePost["concepto"], 
                        $apuntePost["cantidad"], $apuntePost["fecha"], $user->getId());

                try{
                    // Persisto el apunte en la base de datos y 
                    // tambien se lo añado a la coleccion de apuntes del usuario
                    if($apunte->persist(BD::getConexion())){
                        $_SESSION["user"]->getApuntes()->add($apunte);
                        $message = "Apunte contable añadido correctamente";
                        include './Views/menu.php';
                    }
                    else{
                        $message = "No se ha podido añadir el apunte contable";
                        include './Views/menu.php';
                    }
                } catch (PDOException $ex) {
                    $message = "Ha ocurrido un error en el acceso a la base de datos";
                    include './Views/logIn.php';
                }
            }
            // redireccion en caso de que la cantidad introducida no fuera un numero
            else{
                $message = "La cantidad tiene que ser un numero";
                include './Views/nuevo.php';
            }
        }
        
        // Si el usuario quere saber el saldo actual
        // Genero el saldo actual y se lo muestro 
        else if(isset($_POST["estado"])){
            $message = "Actualmente el saldo es de ". $user->saldoActual(). " €";
            include './Views/menu.php';
        }
        
        // Si el usuario quiere saber los ingresos o los gastos entre 2 fechas
        else if(isset($_POST["resumen"])){
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFin = $_POST["fechaFin"];
            
            // Compruebo que es lo que quiere saber el usuario
            // con el valor del boton que ha pulsado
            if($_POST["resumen"] == "Obtener ingresos"){
                $tipo =  1;
            }
            else{
                $tipo = 0;
            }
             
            // Obtengo el resumen de las operaciones que el usuario ha solicitado
            // y se lo muestro en la vista resumen
            $resumen = Apunte::getApuntesByFechas(BD::getConexion(), $tipo, $fechaInicio, $fechaFin);
            
            include './Views/resumen.php';
            
        }
        
        // Si el usuario quere generar un XML con todas las operaciones que ha realizado
        // incluyo la vista xml.php que solo genera y guarda el archivo en la carpeta xml
        // y le redirijo al menu
        else if(isset($_POST["xml"])){
            include './Views/xml.php';
            $message = "XML generado en la carpeta xml";
            include './Views/menu.php';
        }
        
        // Si no ha soliticado nada le envio la vista del menu
        else{
            include './Views/menu.php';
        }
    }
    // Si el usuario no tiene una sesion valida
    else{
        if(isset($_POST["logIn"])){
            $userName = $_POST["userName"];
            $pass = md5($_POST["pass"]);
            try{
                $user = User::getUserByCredentials(BD::getConexion(), $userName, $pass);
                if($user){
                    $_SESSION["user"] = $user;
                    include './Views/menu.php';
                }
                else{
                    $message = "No se ha podido hacer Log In, revisa las crendenciales";
                    include './Views/logIn.php';
                }
            } catch (PDOException $ex) {
                $message = "Ha ocurrido un error en el acceso a la base de datos";
                include './Views/logIn.php';
            }
        }
        
        // Si el usuario solicita la vista para registrarse se la envio 
        else if(isset ($_POST["regForm"])){
            include './Views/register.php';
        }
        
        // Proceso el registro del usuario
        else if(isset ($_POST["register"])){
            $userName = $_POST["userName"];
            $pass = md5($_POST["pass"]);
            // creo un nuevo User y le relleno los campos UserName y Pass
            // con los valores del formulario
            $user = new User();
            $user->setUserName($userName);
            $user->setPass($pass);
            try {
                // Persisto al usuario en la base de datos y le redirijo a la vista de login
                if($user->persist(BD::getConexion())){
                    $message = "Usuario correctamente registrado";
                    include './Views/logIn.php';
                }
                else{
                    $message = "No se ha podido registrar el usuario";
                    include './Views/register.php';
                }
            } catch (PDOException $ex) {
                $message = "Ha ocurrido un error en el acceso a la base de datos";
                include './Views/logIn.php';
            }
        }
        // Si no ha soliticado nada y no tiene una sesion activa le envio la vista de login
        else{
            include './Views/logIn.php';
        }
    }
    