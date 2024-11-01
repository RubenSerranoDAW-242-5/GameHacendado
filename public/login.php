<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="login" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/js/loadout.js" defer></script>
    <?php
    session_start();

    include '../includes/header.php';

    $bd->conectar();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['usuario']) && isset($_POST['contra'])) {

            include "../includes/comprobacionUsuario.php";
            
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
<?php include '../includes/footer.php'; ?>

</html>