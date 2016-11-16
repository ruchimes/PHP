<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
    </head>
    <body>
        
        <h1>Registro de nuevo usuario</h1>
        
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
        <form action="../index.php" method="POST">
            Usuario: <input type="text" name="userName" value="" required />
            Contraseña: <input type="password" name="pass" value="" required />
            <input type="submit" value="Enviar" name="procRegis" />
            <a href="./../index.php">Log In</a>
        </form>
        
    </body>
</html>
