<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/zonaAdmin.css">
    
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="contenedor">
        <button class="btn-usuario" onclick="window.location.href='zonaUsuarios.php'">Usuario</button>
        <button class="btn-cartas" onclick="window.location.href='zonaCartas.php'">Cartas</button>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>