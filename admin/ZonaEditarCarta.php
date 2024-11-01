<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Carta</title>

    <link rel="stylesheet" href="../assets/css/editarCarta.css">
    <?php

    session_start();

    include '../includes/header.php'; ?>
    <?php





    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include "../includes/editarCarta.php";
    }

    ?>
</head>

<body>

    <h1>Editar Carta</h1>
    <?php if (isset($_GET['edit'])) {
        $bd->conectar();

        $idEditar = $_GET['edit'];

        $query = "SELECT * FROM carta WHERE id = $idEditar";
        $cartaEditar = $bd->querySelectUno($query);

        $bd->desconectar();
    } ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <div class="cartaEditar">

            <img src="<?php echo "../assets/images/" . $cartaEditar['img']; ?>" alt="<?php echo $cartaEditar['nombreCarta']; ?>"
                class="carta-img">

            <label for="nombreCarta">Nombre de la Carta:</label>
            <input type="text" name="nombreCarta" value="<?php echo htmlspecialchars($cartaEditar['nombreCarta']); ?>" required>

            <label for="tipoCarta">Tipo de Carta:</label>
            <input type="text" name="tipoCarta" value="<?php echo htmlspecialchars($cartaEditar['tipoCarta']); ?>" required>

            <label for="costeCarta">Coste de Carta:</label>
            <input type="text" name="costeCarta" value="<?php echo htmlspecialchars($cartaEditar['costeCarta']); ?>">

            <label for="color">Color:</label>
            <input type="text" name="color" value="<?php echo htmlspecialchars($cartaEditar['color']); ?>" required>

            <label for="codigoCarta">Código de Carta:</label>
            <input type="text" name="codigoCarta" value="<?php echo htmlspecialchars($cartaEditar['codigoCarta']); ?>" required>

            <label for="precioCarta">Precio:</label>
            <input type="number" step="0.01" name="precioCarta" value="<?php echo htmlspecialchars($cartaEditar['precioCarta']); ?>" required>

            <input type="hidden" value="<?php echo htmlspecialchars($cartaEditar['id']); ?>" name="id">

            <button type="submit">Actualizar Carta</button>

            <a href="../admin/zonaCartas.php" class="boton-cancelar">Cancelar</a>

        </div>

    </form>


</body>

<?php include '../includes/footer.php'; ?>

</html>