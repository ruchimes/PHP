<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resumen de partida</title>
    </head>
    <body>
        <h1>Resumen de la partida con ID <?php echo $game->getId(); ?></h1>
        
        <ul>
            <li>Palabra a adivinar: <?php echo $game->getWord(); ?></li>
            <li>Progreso en la partida: <?php echo $game->getProgress(); ?></li>
            <li>Numero de intentos: <?php echo $game->getNumAttempts(); ?></li>
            <li>Letras usadas: <?php echo implode("-", $game->getLetters()); ?></li>
            <li>Jugadas: 
                <ol>
                    <?php 
                        while($move = $game->getMoves()->iterate()) {
                            echo "<li>Letra: ".$move->getLetter()."<br>Palabra final: ".$move->getFinalWord()."</li>";
                        }
                    ?>
                </ol>    
            </li>
            <li>Finalizada: <?php echo $game->getEnd() ? "SI": "NO"; ?></li>
        </ul>
        
        <form name="for" action="../index.php" method="POST">
            <input type="submit" value="Volver al menu" />
        </form>
        
    </body>
</html>

<?php

// Genera el XML

$clas = <<<XML
<?xml version='1.0' standalone='yes'?>
<partida>
</partida>
XML;

$xml = new SimpleXMLElement($clas);

$xml->addChild('Palabra',$game->getWord());
$xml->addChild('Progreso',$game->getProgress());
$xml->addChild('NumeroIntentos',$game->getNumAttempts());
$xml->addChild('LetrasUsadas',implode("-", $game->getLetters()));
$xml->addChild('Finalizada',$game->getEnd() ? "SI" : "NO");

while($move = $game->getMoves()->iterate()) {
    $jug = $xml->addChild('jugada');
    $jug->addChild("letra", $move->getLetter());
    $jug->addChild("palabraFinal", $move->getFinalWord());
}      
$fichero =  $xml->asXML();
$archivo = fopen("xml/partida.xml", "w+");
fwrite($archivo, $fichero);


