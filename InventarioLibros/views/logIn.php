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
        
        <h1>LogIn de usuario</h1>
        
        
        <form action="../index.php" method="POST">
            
            Usuario: <input type="text" name="userName" value="" /> <br>
            
            Pass: <input type="password" name="pass" value="" /> <br>
            
            <input type="submit" value="Enviar" name="logIn" /><br>
            <input type="submit" value="Registro" name="register" /><br>
            
        </form>
        
    </body>
</html>
