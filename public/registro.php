<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../assets/css/registro.css">
    <?php

    include("../config/ConexionBD.php");
    $bd->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["nombre"]) && isset($_POST["apellido"]) &&
            isset($_POST["email"]) && isset($_POST["dni"]) && isset($_POST["direccion"]) && isset($_POST["telefono"])
            && isset($_POST['contra']) && isset($_POST['confirmacion_contra'])
        ) {
            if ($_POST['contra'] == $_POST['confirmacion_contra']) {

                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $dni = $_POST['dni'];
                $contra = $_POST['contra'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];

                $query = "INSERT INTO Usuario (nombre, apellido, email, dni, contraseña, rol, direccion, telefono)
                VALUES ('$nombre','$apellido','$email','$dni','$contra','usuario','$direccion','$telefono')";

                $res = $bd->queryInsert($query);
                if ($res) {
                    header("Location:/login.php");
                    $bd->desconectar();
                } else {
                    echo Err('Se ha producido un error al crear el usuario');
                    $bd->desconectar();
                }
            } else {
                echo Err("Las contraseñas no coinciden");
            }

        } else {
            echo Err("Te falta algun campo por rellenar");
        }
    }

    ?>
</head>

<body>
    <div id="formLogin">
        <img id="logo" src="../assets/images/logo.webp" alt="Logo">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre" required>

            <label for="apellido">Apellidos</label>
            <input type="text" id="apellido" name="apellido" placeholder="Introduce tu apellido" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Introduce tu correo" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" placeholder="Introduce tu DNI" required>

            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" name="direccion" placeholder="Introduce tu direccion" required>

            <label for="telefono">Telefono</label>
            <input type="text" id="telefono" name="telefono" placeholder="Introduce tu numero de telefono" required>

            <label for="contra">Contraseña</label>
            <input type="password" id="contra" name="contra" placeholder="Introduce tu contraseña" required>

            <label for="confirmacion_contra">Confirma Contraseña</label>
            <input type="password" id="confirmacion_contra" name="confirmacion_contra" placeholder="Confirma tu contraseña" required>

            <input type="submit" value="Register">
        </form>

        <p>Ya tienes una cuenta <a href="login.php">Inicia Sesion</a>.</p>
    </div>
</body>

</html>