<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Felicidades, has ganado con la palabra 
        <?php
            echo $partida->getWord(). " en " . $partida->getNumIntentos();
        ?>
         intentos</h1>
    </body>
</html>
