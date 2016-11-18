<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resumen en tiempo</title>
    </head>
    <body>
        <?php
            echo "<h1>";
            if($tipo){
                echo "Ingresos"; 
            }
            else{
                echo "Gastos";
            }
            echo " entre ". $fechaInicio . " y ". $fechaFin. "</h1>";
        ?>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
                while($apunte = $resumen->iterate()){
                    $tipo = $apunte->getTipo() ? "Ingreso" : "Gasto";
                    echo "<tr>";
                    echo "<td>".$tipo."</td>";
                    echo "<td>".$apunte->getConcepto()."</td>";
                    echo "<td>".$apunte->getCantidad()."</td>";
                    echo "<td>".$apunte->getFecha()."</td>";
                    echo "</tr>";
                }
            ?>
            
            </tbody>
        </table>

        <br><br><br><br>
        
        <form name="formIngresos" action="../index.php" method="POST">
            <input type="submit" value="Atras" name="" />
        </form>
    </body>
</html>
