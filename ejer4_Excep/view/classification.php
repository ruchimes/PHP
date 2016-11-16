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
            // put your code here
        ?>
        
        <h1>Clasificacion hasta el momento de la liga <?php echo $user->getLeague()->getName(); ?></h1>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Puntos</th>
                    <th>Goles a favor</th>
                    <th>Goles en contra</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($classification as $team => $res){
                    echo "<tr>";
                        echo "<td>$team</td>";
                        echo "<td>".$res['pt']."</td>";
                        echo "<td>".$res['gf']."</td>";
                        echo "<td>".$res['ga']."</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <br><br><br>
        <form action="../index.php" method="POST">
            <input type="submit" value="Atras" />
        </form>
    </body>
</html>


<?php

// Genera el XML

$clas = <<<XML
<?xml version='1.0' standalone='yes'?>
<clasificacion>
</clasificacion>
XML;

$xml = new SimpleXMLElement($clas);

foreach ($classification as $team => $res) {
    $equi = $xml->addChild('equipo');
    $equi->addChild("nombre", $team);
    $equi->addChild("puntos", $res["pt"]);
    $equi->addChild("golesFavor", $res["gf"]);
    $equi->addChild("golesContra", $res["ga"]);
}
      
$fichero =  $xml->asXML();
$archivo = fopen("xml/clasificacion.xml", "w+");
fwrite($archivo, $fichero);


