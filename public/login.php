<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="formLogin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario"><br>
        <label for="contra">Contraseña:</label>
        <input type="password" name="contra" id="contra"><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>