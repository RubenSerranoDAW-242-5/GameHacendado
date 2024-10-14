<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="../assets/js/index.js" defer></script>
    <?php

    session_start();
    
    include '../includes/header.php';
    include '../config/ConexionBD.php';

    $bd->conectar();
    $query = "SELECT * FROM Carta";
    $listadoCartas = $bd->querySelectMuchos($query);
    $bd->desconectar();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idCarta = $_POST['idCarta'];
        $catidad_de_cartas = intval($_POST['cantidad-' . $idCarta]);
        $_SESSION['carrito-contador']++;
        
        
        $query = '';

        header("Location: " . $_SERVER['PHP_SELF'] . "?lineasPedido=" . $_SESSION['carrito-contador'] .
        "&cantidadCartas=" . $catidad_de_cartas.
        "&idCarta=$idCarta");

        exit();
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

                    <?php if (isset($_SESSION['email'])): ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="cantidad-controles">
                                <button type="button" class="btn-menos" data-id="<?php echo $carta['id']; ?>">-</button>
                                <input type="number" id="cantidad-<?php echo $carta['id']; ?>" min="1"
                                    max="<?php echo $carta['cantidad']; ?>" name="cantidad-<?php echo $carta['id']; ?>"
                                    value="1"readonly>
                                <button type="button" class="btn-mas" data-id="<?php echo $carta['id']; ?>">+</button>
                            </div>

                            <input type="hidden" name="idCarta" value="<?php echo $carta['id']; ?>">
                            <button type="submit">Añadir a carrito</button>
                        </form>
                    <?php else: ?>
                        <p>Cantidad: <?php echo htmlspecialchars($carta['cantidad']); ?></p>
                        <form>
                            <input type="hidden" name="idCarta" value="<?php echo $carta['id']; ?>">
                            <button type="submit" disabled>Añadir a carrito</button>
                            <p style="color: red;">Inicia sesión para añadir al carrito</p>
                        </form>
                    <?php endif; ?>
                    <br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<?php include '../includes/footer.php'; ?>

</html>