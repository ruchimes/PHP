<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
        
        <h2>Introduzca sus credenciales para acceder a la pagina web</h2>
        <form name="form" action="index.php" method="POST">
            <input type="text" name="user" value="" />
            <input type="password" name="pass" value="" />
            <input type="submit" value="Enviar" name="logIn" />
        </form>
    </body>
</html>
