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
        
        <h1>Incluir nuevo libro</h1>
        
        <form action="../index.php" method="POST">
            
            Titulo: <input type="text" name="book[name]" value="" /> <br>
            Escritor: <input type="text" name="book[writter]" value="" /> <br>
            Editorial: <input type="text" name="book[edit]" value="" /> <br>
            Año: <input type="number" name="book[year]" value="" /> <br>
            Nº pag.: <input type="number" name="book[pag]" value="" /> <br>
            
            <input type="submit" value="Enviar" name="procNew" /><br>
            <input type="submit" value="Enviar" /><br>
            
        </form>
        
    </body>
</html>
