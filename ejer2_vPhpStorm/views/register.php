<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h2>Introduzca sus datos para registrarse</h2>
        <form name="form" action="./../index.php" method="POST">
            Usuario: <input type="text" name="user" value="" />
            Contraseña: <input type="password" name="pass" value="" />
            Email: <input type="text" name="email" value="" />
            Pintor favorito: <select name="painter">
                <option>picasso</option>
                <option>goya</option>
                <option>velazquez</option>
                <option>dali</option>
            </select>
            <input type="submit" value="Enviar" name="register" />
        </form>
    </body>
</html>
