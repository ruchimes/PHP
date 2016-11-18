<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
    </head>
    <body>
        <?php
            if(isset($message)){
                echo "<h1>$message</h1>";
            }
        ?>
        
        <h1>Contabilidad de la familia de <?php echo $user->getUserName();?></h1>
        
       
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
                while($apunte = $user->getApuntes()->iterate()){
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
        
        <form name="formMenu" action="../index.php" method="POST">
            
            <input type="submit" value="LogOut" name="logOut" />
            <input type="submit" value="Estado saldo" name="estado" />
            <input type="submit" value="Nuevo apunte" name="nuevo" />
            <input type="submit" value="Crear XML" name="xml" />
            
            <br><br><br>
            
            Fecha Inicio:<input type="date" name="fechaInicio" value="" /><br>
            Fecha Fin:<input type="date" name="fechaFin" value="" /><br>
            <input type="submit" value="Obtener ingresos" name="resumen" />
            <input type="submit" value="Obtener gastos" name="resumen" />
            
        </form>
        
    </body>
</html>
