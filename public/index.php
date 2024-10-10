<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="../assets/js/index.js" defer></script>
    <?php
    include '../includes/header.php';
    include("../config/ConexionBD.php");

    $bd->conectar();
    session_start();

    $query = "SELECT * FROM Carta";
    $listadoCartas = $bd->querySelectMuchos($query);
    $bd->desconectar();
    if (isset($_SESSION['usuario'])) {
       //habilitar botones
    }else{
        //deshabilitar botones
    }
    ?>
</head>

<body>
    <div id="flex-box">
        <div id="grid">
            <?php foreach ($listadoCartas as $carta): ?>
                <div class="carta" hr>
                    <img src="<?php echo "../assets/images/" . $carta['img']; ?>" alt="<?php echo $carta['nombreCarta']; ?>"
                        class="carta-img">
                    <h3><?php echo htmlspecialchars($carta['nombreCarta']); ?></h3>
                    <p>Tipo: <?php echo htmlspecialchars($carta['tipoCarta']); ?></p>
                    <p>Coste: <?php echo htmlspecialchars($carta['costeCarta']); ?></p>
                    <p>Color: <?php echo htmlspecialchars($carta['color']); ?></p>
                    <p>Código: <?php echo htmlspecialchars($carta['codigoCarta']); ?></p>
                    <p>Precio: <?php echo number_format($carta['precioCarta'], 2); ?>€</p>
                    <form action="" method="post">
                        <input type="hidden" name="idCarta" value="<?php echo $carta['id']; ?>">
                        <button type="submit">Añadir a carrito</button>
                    </form>
                    <br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>