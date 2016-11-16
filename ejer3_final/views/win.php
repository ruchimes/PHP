<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Felicidades, has ganado con la palabra 
        <?php
            $game = $_SESSION["user"]->getCurrentGame();
            echo $game->getWord(). " en " . $game->getNumAttempts();
        ?>
         intentos</h1>
        
        <a href="../index.php">Volver al Menú</a>
        
    </body>
</html>
