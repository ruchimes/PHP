<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
    </head>
    <body>
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
        
        <h1>Menu por hacer</h1>
        
        <form action="../index.php" method="POST">
            
            <?php
                $i=1;
                while($day = $user->getLeague()->getDays()->iterate()) {
                    $id = $day->getId();
                    echo "<input type=radio name=day value=$id /> Jornada $i <br>";
                    $i++;
                }
            
            ?>
            <br><br>
            <input type="submit" value="Editar" name="editDay" />
            <input type="submit" value="Clasificacion" name="classif" />
            <input type="submit" value="Log Out" name="logOut" />
        </form>
        
    </body>
</html>
