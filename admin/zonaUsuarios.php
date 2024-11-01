<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../assets/css/zonaUsuario.css">
    <?php
    session_start();
    include "../includes/header.php"; ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include "../includes/editarUsuario.php";
    }

    ?>
</head>

<body>
    <?php
    $bd->conectar();

    $query = "SELECT * FROM Usuario";
    $resultado = $bd->querySelectMuchos($query);

    $bd->desconectar();
    ?>

    <h1>Lista de Usuarios</h1>

    <div class="contenedor-tabla">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['apellido']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['dni']; ?></td>
                        <td><?php echo $usuario['direccion']; ?></td>
                        <td><?php echo $usuario['telefono']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $usuario['id']; ?>">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_GET['edit'])): ?>
        <?php

        $bd->conectar();

        $idEditar = $_GET['edit'];

        $query = "SELECT * FROM Usuario WHERE id = $idEditar";
        $usuarioEditar = $bd->querySelectUno($query);

        $bd->desconectar();
        ?>


        <div class="contenedor-tabla-editar">

            <h2>Editar Usuario</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <input type="hidden" name="id" value="<?php echo $usuarioEditar['id']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $usuarioEditar['nombre']; ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $usuarioEditar['apellido']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $usuarioEditar['email']; ?>" required>

                <label for="dni">DNI:</label>
                <input type="text" name="dni" value="<?php echo $usuarioEditar['dni']; ?>" required>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" value="<?php echo $usuarioEditar['direccion']; ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo $usuarioEditar['telefono']; ?>" required>

                <div>
                    <label for="rol">Rol:</label>
                    <select name="rol" class="rol" required>
                        <option value="admin" <?php echo ($usuarioEditar['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                        <option value="usuario" <?php echo ($usuarioEditar['rol'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                    </select>
                </div>

                <button type="submit">Actualizar Usuario</button>

                <a href="zonaUsuarios.php">Cancelar</a>
            </form>

        </div>
    <?php endif; ?>

</body>
<?php include "../includes/footer.php"; ?>

</html>