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
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
        
        <h1>Aun no tienes liga</h1>
        <h2>Introduce el nombre y los equipos de la liga para generarla</h2>
        
        <form action="../index.php" method="POST">
            Nombre de la liga: <input type="text" name="name" value="" required />  <br>
            Equipos: <input type="text" name="teams" value="" required />
            <input type="submit" value="Enviar" name="newLeague"/>
        </form>
        
    </body>
</html>
