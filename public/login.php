<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="login" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <?php

    include("../config/ConexionBD.php");
    $bd->conectar();



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['usuario']) && isset($_POST['contra'])) {
            $usuarioBD = $_POST['usuario'];
            $contraBD = $_POST['contra'];

            $query = "SELECT email,contraseña FROM Usuario;";

            $resultado = $bd->querySelect($query);
            if ($resultado && $resultado['contraseña'] == $contraBD && $resultado['email'] == $usuarioBD) {

                session_start();
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['rol'] = $resultado['rol'];
                if ($resultado['rol'] === "admin") {
                    header("../admin/index.php?email=&&email=" . $resultado['email'] .
                        "&&rol=" . $resultado['rol']);
                } else {
                    header("Location:/index.php?email=&&email=" . $resultado['email'] .
                        "&&rol=" . $resultado['rol']);
                }

            } else if ($resultado['contraseña'] != $contraBD || $resultado['email'] != $usuarioBD) {
                $errorMessage = "Usuario o Contraseña son incorrectos";
            } else {
                $errorMessage = "Usuario o Contraseña son incorrectos";
            }
        }
    }
    ?>
</head>

<body>

    <form id="formLogin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <img src="../assets/images/logo.webp" id="logo">

        <label for="usuario">Email:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Mete tu correo" required><br>

        <label for="contra">Contraseña:</label>
        <input type="password" name="contra" id="contra" placeholder="Inserte la contraseña" required><br>

        <?php if (!empty($errorMessage)): ?>
            <div id="mensajeError"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <input type="submit" value="Enviar">

        <p>¿No tienes una cuenta? <a href="registro.php">Registrate pinchado encima</a>.</p>
    </form>
</body>

</html>