<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="login" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <?php
    session_start();
    include("../config/ConexionBD.php");
    $bd->conectar();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['usuario']) && isset($_POST['contra'])) {
            $usuarioEmail = $_POST['usuario'];
            $contra = $_POST['contra'];

            $query = "SELECT id,email,contraseña,rol FROM Usuario WHERE email='$usuarioEmail' LIMIT 1";

            $resultado = $bd->querySelectUno($query);
            if ($resultado['contraseña'] == $contra && $resultado['email'] == $usuarioEmail) {

                $_SESSION['email'] = $resultado['email'];
                $_SESSION['id'] = (int)$resultado['id'];
                $_SESSION['rol'] = $resultado['rol'];
                $_SESSION['carrito-contador'] = 0;

                if ($resultado['rol'] == "admin") {
                    header("Location: ../admin/index.php?id= " . $_SESSION['id'] . "&&email=" . $_SESSION['email'] .
                        "&&rol=" . $_SESSION['rol']);
                    $bd->desconectar();
                    exit;
                } else {
                    header("Location: ../public/index.php?id= " . $_SESSION['id'] . "&&email=" . $_SESSION['email'] .
                        "&&rol=" . $_SESSION['rol']);
                    $bd->desconectar();
                    exit;
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