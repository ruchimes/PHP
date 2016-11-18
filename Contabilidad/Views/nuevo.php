<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo apunte Contable</title>
    </head>
    <body>
        <?php
            if(isset($message)){
                echo "<h1>$message</h1>";
            }
        ?>
        
        <h1>Introduce las cualidades del apunte contable</h1>
        <h2>Para introducir decimales, usa el punto (.)</h2>
        
        <form name="formNuevo" action="../index.php" method="POST">
            
            <h3>Tipo de apunte</h3>
            <input type="radio" name="apunte[tipo]" value="1" /> Ingreso <br>
            <input type="radio" name="apunte[tipo]" value="0" /> Gasto <br>
            
            Concepto: <input type="text" name="apunte[concepto]" value="" /> <br>
            Cantidad: <input type="real" name="apunte[cantidad]" value="" /> <br>
            Fecha: <input type="date" name="apunte[fecha]" value="" /> <br>
            
            <br><br>
            <input type="submit" value="Guardar" name="procNuevo" />
            <input type="submit" value="Atras" name="" />
            
        </form>
    </body>
</html>
