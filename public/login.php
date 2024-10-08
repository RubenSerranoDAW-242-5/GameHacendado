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
            $usuario = $_POST['usuario'];
            $contra = $_POST['contra'];

            $query = "SELECT email,contraseña,rol FROM Usuario WHERE email='$usuario' LIMIT 1";

            $resultado = $bd->querySelect($query);

            if ($resultado['contraseña'] == $contra && $resultado['email'] == $usuario) {
                session_start();
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['rol'] = $resultado['rol'];

                if ($resultado['rol'] == "admin") {
                    header("Location: ../admin/index.php?email=" . $resultado['email'] .
                        "&&rol=" . $resultado['rol']);
                    $bd->desconectar();
                } else {
                    header("Location:../public/index.php?email=" . $resultado['email'] .
                        "&&rol=" . $resultado['rol']);
                    $bd->desconectar();
                }

            } else if ($resultado['contraseña'] != $contra || $resultado['email'] != $usuario) {
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
        <input type="text" name="usuario" id="usuario" placeholder="Inserta tu correo" required><br>

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