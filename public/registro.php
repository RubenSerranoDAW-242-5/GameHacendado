<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../assets/css/registro.css">
</head>
<body>
    <div id="formLogin">
        <img id="logo" src="../assets/images/logo.webp" alt="Logo">

        <form action="process-register.php" method="POST">
            
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre" required>
            
            <label for="apellido">Apellidos</label>
            <input type="text" id="apellido" name="apellido" placeholder="Introduce tu apellido" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" placeholder="Introduce tu DNI" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Introduce tu correo" required>

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
