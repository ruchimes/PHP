<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h2>Modifique sus datos</h2>
        <form name="form" action="./../index.php" method="POST">
            Usuario: <input type="text" name="user" value=<?php echo $user->getUser() ?> />
            Contraseña: <input type="password" name="pass" value=<?php echo $user->getPass() ?> />
            Email: <input type="text" name="email" value=<?php echo $user->getEmail() ?> />
            Pintor favorito: <select name="painter">
                <option>picasso</option>
                <option>goya</option>
                <option>velazquez</option>
                <option>dali</option>
            </select>
            <input type="submit" value="Enviar" name="procMod" />
        </form>
    </body>
</html>
