<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Partida en curso</title>
    </head>
    <body>
        
        <h1>Introduce letras para adivinar la palabra secreta</h1>
        
        <?php
            $game = $_SESSION["user"]->getCurrentGame();
            echo "<h2>". implode("  ", str_split($game->getProgress())) ."</h2>";
        ?>

        
        <form action="../index.php" method="POST">
            
            <input type="text" name="letter" value="" size="1" max="1" />
            <input type="submit" value="Enviar" name="send" />
            <input type="submit" value="Dejar Partida" name="stop" />
            
        </form>
        
        <fieldset>
            <legend><h3>Letras Usadas:</h3></legend>
            <?php
                echo implode(" - ", $game->getLetters());
            ?>
        </fieldset>
        
        
    </body>
</html>
