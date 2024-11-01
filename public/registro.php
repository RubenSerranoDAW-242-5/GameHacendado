<!DOCTYPE html>
<html lang="es">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/registro.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="../assets/js/loadout.js" defer></script>
    <?php

    include "../includes/header.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include "../includes/creacionUsuario.php";
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
            <input type="password" id="confirmacion_contra" name="confirmacion_contra"
                placeholder="Confirma tu contraseña" required>

            <?php if (!empty($errorMessage)): ?>
                <div id="mensajeError"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <input type="submit" value="Register">
        </form>

        <p>Ya tienes una cuenta <a href="login.php">Inicia Sesion</a>.</p>
    </div>
</body>
<?php include "../includes/footer.php"; ?>

</html>