<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Felicidades, has acertado el numero en 
        <?php
            echo $game->getAttemps();
        ?>
         intentos</h1>
        
        <h2><a href="index.php">Juega de nuevo</a></h2>
    </body>
</html>
