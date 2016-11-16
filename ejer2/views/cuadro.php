<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Cuadro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <h1>Hola, 
            <?php 
            echo ($_SESSION['user']->getUser());?>
        </h1>
        
        <form action="../index.php" method="POST">
            <input type="submit" value="LogOUT" name="logOut" /> <br><br>
            <input type="submit" value="Modificar Datos" name="modify" />
        </form>
        
        <img src=<?php echo "./../img/" . $user->getPainter() . ".jpg" ?> />

        

    </body>
</html>
