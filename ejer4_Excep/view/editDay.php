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
        
        <h1>Introduce los resultados de los partidos</h1>
        <h2>Jornada <?php echo $day->getDate();?></h2>
        
        <form action="../index.php" method="POST">

            <?php
                $i=1;
                while($match = $day->getMatches()->iterate()){
                    
                    $id = $match->getId();
                    $team1 = $match->getTeam1();
                    $team2 = $match->getTeam2();
                    $goals1 = $match->getGoals1();
                    $goals2 = $match->getGoals2();
                    
                    echo "<fieldset><legend>Partido $i</legend>";
                    echo $team1->getName(). " <input type=number name=match[$id][1] value=$goals1 />"
                            . " - ". $team2->getName(). " <input type=number name=match[$id][2] value=$goals2 />";      
                    echo "</fieldset>";
                    $i++;
                }
            ?>
            <input type="submit" value="Enviar" name="sendDay" />
        </form>
        
    </body>
</html>
