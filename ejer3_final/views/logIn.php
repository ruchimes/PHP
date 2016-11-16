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
            if(isset($message)){
                echo "<h3>$message</h3>";
            }
        ?>
        
        <form action="../index.php" method="POST">
            
            User: <input type="text" name="userName" value="" />
            Pass: <input type="password" name="pass" value="" />
            
            <input type="submit" value="Enviar" name="procLogIn" />
            <input type="submit" value="Registrate" name="register" />
            
        </form>
        
    </body>
</html>
