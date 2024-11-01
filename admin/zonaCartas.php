<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/zonaCartas.css">
    <script src="../assets/js/zonaCartas.js" defer></script>
    <?php

    session_start();

    include '../includes/header.php';

    if (isset($_SESSION["email"])) {
        $idUsuario = $_SESSION['id'];
    }


    $bd->conectar();

    $query = "SELECT * FROM Carta";
    $listadoCartas = $bd->querySelectMuchos($query);

    $bd->desconectar();



    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $metodo = $_POST['metodoPost'];

        switch ($metodo) {

            case 'añadirExistencia':

                $bd->conectar();

                $idCarta = $_POST['idCarta'];
                $cantidadAñadir = $_POST["cantidad-$idCarta-añadir"];


                $query = "UPDATE carta SET cantidad = cantidad + $cantidadAñadir WHERE id = $idCarta";

                $resultado = $bd->queryUpdate($query);

                header("Location: ../admin/zonaCartas.php");

                break;
            case 'busqueda':

                include "../includes/busqueda.php";

                break;
            default:
                echo "error al recibir el metodo del post";
                break;
        }
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
                    <p id="precioCarta">Precio: <?php echo number_format($carta['precioCarta'], 2); ?>€</p>
                    <p id="cantidad-carta">Cantidad: <?php echo $carta['cantidad']; ?></p>

                    <a href="../admin/zonaEditarCarta.php?edit=<?php echo $carta['id']; ?>" class="boton-editar">Editar Carta</a>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                        <div class="cantidad-controles-añadir">
                            <button type="button" class="btn-menos" data-id="<?php echo $carta['id']; ?>">-</button>
                            <input type="number" id="cantidad-<?php echo $carta['id']; ?>-añadir" min="1"
                                name="cantidad-<?php echo $carta['id']; ?>-añadir" value="1" readonly>
                            <button type="button" class="btn-mas" data-id="<?php echo $carta['id']; ?>">+</button>
                        </div>

                        <input type="hidden" value="añadirExistencia" name="metodoPost">
                        <input type="hidden" name="idCarta" value="<?php echo $carta['id']; ?>">
                        <button type="submit">Añadir existencias</button>
                    </form>
                    <br>
                </div>

            <?php endforeach; ?>


        </div>
    </div>
</body>

<?php include '../includes/footer.php'; ?>

</html>