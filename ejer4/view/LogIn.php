<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
    </head>
    <body>
        
        <h1>Log in usuario</h1>
        
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
        <form action="../index.php" method="POST">
            Usuario: <input type="text" name="userName" value=""  />
            Contraseña: <input type="password" name="pass" value=""  />
            <input type="submit" value="Entrar" name="procLogIn" />
            <input type="submit" value="Registro" name="register" />
        </form>
        
    </body>
</html>
