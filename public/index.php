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

    // echo "email: " . $_SESSION['email'] . "\n";
    // echo "id: " . $_SESSION['id'] . "\n";
    // echo "rol: " . $_SESSION['rol'] . "\n";


    include '../includes/header.php';
    include("../config/ConexionBD.php");

    $bd->conectar();


    $query = "SELECT * FROM Carta";
    $listadoCartas = $bd->querySelectMuchos($query);
    $bd->desconectar();
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

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <div class="cantidad-controles">
                            <button type="button" class="btn-menos" data-id="<?php echo $carta['id']; ?>">-</button>
                            <input type="number" id="cantidad-<?php echo $carta['id']; ?>" value="1" min="1" max="<?php echo $carta['cantidad']; ?>" readonly>
                            <button type="button" class="btn-mas" data-id="<?php echo $carta['id']; ?>">+</button>
                        </div>
                        <form action="" method="post">
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

</html>