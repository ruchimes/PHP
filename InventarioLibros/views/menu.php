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
        
        <form action="../index.php" method="POST">
            
            
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Editorial</th>
                        <th>Escritor</th>
                        <th>Año</th>
                        <th>Paginas</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    
            <?php
            
                    while($book = $user->getBooks()->iterate()){
                        
                        echo "<tr>";
                        echo "<td>".$book->getName()."</td>";
                        echo "<td>".$book->getEdit()."</td>";
                        echo "<td>".$book->getWritter()."</td>";
                        echo "<td>".$book->getYear()."</td>";
                        echo "<td>".$book->getPages()."</td>";
                        echo "<td><input type=submit value=Borrar name=del[".$book->getId()."] /></td>";
                        echo "</tr>";
                        
                    }
            
            
            
            ?>
            
                </tbody>
            </table>
            
            
            <input type="submit" value="Nuevo Libro" name="newBook"/>
            <input type="submit" value="Log Out" name="logOut"/>
            <input type="submit" value="XML" name="xml"/>
            
        </form>
        
    </body>
</html>
