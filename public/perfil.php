<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <?php
    session_start();
    // include "../config/ConexionBD.php";
    include '../includes/header.php';

    if (isset($_SESSION['id'])) {
        $idUsuario = $_SESSION['id'];
        $bd->conectar();
        $query = "SELECT * FROM Usuario WHERE id = $idUsuario";
        $Usuario = $bd->querySelectUno($query);
        $bd->desconectar();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreCambiar = $_POST["nombre"];
        $apellidoCambiar = $_POST['apellido'];
        $emailCambiar = $_POST['email'];
        $dniCambiar = $_POST['dni'];
        $contraCambiar = $_POST['contra'];
        $direccionCambiar = $_POST['direccion'];
        $telefonoCambiar = $_POST['telefono'];
        $bd->conectar();
        $query = "UPDATE Usuario 
                  SET nombre = '$nombreCambiar', 
                  apellido = '$apellidoCambiar', 
                  email = '$emailCambiar', 
                  dni = '$dniCambiar',
                  contraseña = '$contraCambiar',
                  direccion = '$direccionCambiar', 
                  telefono = '$telefonoCambiar'
                  WHERE id = $idUsuario;";
        $bd->queryUpdate($query);
        $bd->desconectar();
        header("Location:perfil.php");
        exit();
    }
    ?>
</head>

<body>
    <?php if (!empty($Usuario)): ?>
        <div class="usuario">
            <h3>Actualizar Información de Usuario y Visualizacion</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($Usuario['nombre']); ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($Usuario['apellido']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($Usuario['email']); ?>" required>

                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($Usuario['dni']); ?>" required>

                <label for="contra">Contraseña:</label>
                <input type="password" id="contra" name="contra" value="<?php echo htmlspecialchars($Usuario['contraseña']); ?>" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($Usuario['direccion']); ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($Usuario['telefono']); ?>" required>

                <input type="submit" value="Actualizar Datos">
            </form>
        </div>
    <?php else: ?>
        <p class="no-datos">No se encontraron datos de usuario.</p>
    <?php endif; ?>
</body>
<?php include '../includes/footer.php'; ?>

</html>