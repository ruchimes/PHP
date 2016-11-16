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
                echo "<h3>$message</h3>";
            }
        ?>
        
        <h1>Menú</h1>
        
        <form action="../index.php" method="POST">
            <ol type="1">
            <?php
                $games = $_SESSION["user"]->getGames();
                
                for($i=0; $i<$games->getNumObjects(); $i++){
                    echo "<li><input type=radio name=game value=".$games->getObjNum($i)->getId()." />".$games->getObjNum($i)->getProgress()."</li>";
                }
            ?> 
            </ol>   
            
            <input type="submit" value="Log Out" name="logOut" />
            <input type="submit" value="Nueva Partida" name="new" />
            <input type="submit" value="Recuperar Partida" name="retrieve" />
            <input type="submit" value="Resumen de partida" name="xml" />
            
        </form>
        
    </body>
</html>
