<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
    </head>
    <body>
        <?php
            if(isset($message)){
                echo "<h1>$message</h1>";
            }
        ?>
        
        <h1>Introduce nombre de usuario y contraseña para registrarte</h1>
        
        <form name="formRegis" action="../index.php" method="POST">
            
            Usuario: <input type="text" name="userName" value="" />
            Contraseña: <input type="password" name="pass" value="" />
            
            <br><br>
            <input type="submit" value="Registro" name="register" />
            <input type="submit" value="Atras" name="" />
            
        </form>
        
    </body>
</html>
