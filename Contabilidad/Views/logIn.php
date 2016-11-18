<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
    </head>
    <body>
        
        <?php
            if(isset($message)){
                echo "<h1>$message</h1>";
            }
        ?>
        
        <h1>Introduce tus credenciales para hacer Log In</h1>
        
        <form name="formLogIn" action="../index.php" method="POST">
            
            Usuario: <input type="text" name="userName" value="" />
            Contraseña: <input type="password" name="pass" value="" />
            
            <br><br>
            <input type="submit" value="Log In" name="logIn" />
            <input type="submit" value="Registro" name="regForm" />
            
        </form>
        
    </body>
</html>
