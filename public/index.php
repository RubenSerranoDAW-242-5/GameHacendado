<!DOCTYPE html>
<html lang="es">

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

            case 'añadirCarro':

                $bd->conectar();

                $query = "SELECT *
                  FROM Pedidos 
                  WHERE idUsuario = $idUsuario AND estado = 'en-proceso';";
                $resultado = $bd->querySelectUno($query);

                $idCarta = $_POST["idCarta"];
                $catidad_de_cartas = intval($_POST['cantidad-' . $idCarta]);

                $query = "SELECT * FROM Carta WHERE id = $idCarta LIMIT 1";
                $cartaSeleccionada = $bd->querySelectUno($query);

                $precioTotalLinea = (float) $cartaSeleccionada["precioCarta"] * $catidad_de_cartas;

                $bd->desconectar();

                if ($resultado["estado"] !== "en-proceso") {
                    try {
                        $bd->conectar();

                        $query = "SELECT direccion  FROM usuario WHERE id = $idUsuario";
                        $direccionSelect = $bd->querySelectUno($query);
                        $direccionEnvio = $direccionSelect["direccion"];

                        $query = "INSERT INTO Pedidos (fecha, precioTotal, direccionEnvio,idUsuario)
                      VALUES (NULL, NULL, '$direccionEnvio',$idUsuario);";
                        $bd->queryInsert($query);

                        $idPedido = $bd->lastInsertId();

                        $_SESSION['idPedido'] = $idPedido;

                        $query = "INSERT INTO LineaPedidos (cantidad, precioTotalLinea, idPedido,IdCarta)
                      VALUES ($catidad_de_cartas, $precioTotalLinea, $idPedido, $idCarta);";
                        $bd->queryInsert($query);

                        $_SESSION['carrito-contador']++;

                        $idLineaPedido = $bd->lastInsertId();

                        $query = "UPDATE Pedidos SET precioTotal = 
                          (SELECT SUM(precioTotalLinea) FROM LineaPedidos WHERE idPedido = $idPedido) 
                          WHERE id = $idPedido;";
                        $bd->queryUpdate($query);

                    } catch (Exception $e) {
                        echo "Error al insertar: " . $e->getMessage();
                    }
                    $bd->desconectar();
                    header("Location: index.php");
                } else {
                    try {
                        $bd->conectar();

                        $idPedido = $resultado["id"];
                        $_SESSION['idPedido'] = $idPedido;

                        $query = "SELECT idCarta FROM LineaPedidos WHERE idCarta = $idCarta LIMIT 1";
                        $exiteCarta = $bd->querySelectUno($query);
                        $precioCartaId = $cartaSeleccionada["precioCarta"];

                        if (!$exiteCarta) {

                            $query = "INSERT INTO LineaPedidos (cantidad, precioTotalLinea, idPedido,IdCarta)
                                      VALUES ($catidad_de_cartas, $precioTotalLinea, $idPedido, $idCarta);";
                            $_SESSION['carrito-contador']++;
                            $bd->queryInsert($query);

                        } else {

                            $query = "UPDATE LineaPedidos SET cantidad = cantidad + $catidad_de_cartas WHERE idCarta = $idCarta;";
                            $bd->queryUpdate($query);

                            $query = "UPDATE LineaPedidos 
                              SET precioTotalLinea = cantidad *  $precioCartaId
                              WHERE idCarta = $idCarta;";

                            $bd->queryUpdate($query);
                        }

                        $query = "UPDATE Pedidos SET precioTotal = 
                          (SELECT SUM(precioTotalLinea) FROM LineaPedidos WHERE idPedido = $idPedido) 
                          WHERE id = $idPedido;";
                        $bd->queryUpdate($query);

                    } catch (Exception $e) {
                        echo "Error al insertar: " . $e->getMessage();
                    }
                    $bd->desconectar();
                    header("Location: index.php");
                }
                break;
            case 'busqueda':
                $bd->conectar();

                $textoBusqueda = $_POST['textoBusqueda'];
                
                $query = "SELECT * FROM Carta 
                                     WHERE LOWER(nombreCarta) LIKE LOWER('%$textoBusqueda%') OR
                                     LOWER(tipoCarta) LIKE LOWER('%$textoBusqueda%') OR
                                     LOWER(costeCarta) LIKE LOWER('%$textoBusqueda%') OR
                                     LOWER(color) LIKE LOWER('%$textoBusqueda%') OR
                                     LOWER(codigoCarta) LIKE LOWER('%$textoBusqueda%');";

                $listadoCartas = $bd->querySelectMuchos($query);

                $bd->desconectar();

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

                    <?php if (isset($_SESSION['email'])): ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                            <div class="cantidad-controles">
                                <button type="button" class="btn-menos" data-id="<?php echo $carta['id']; ?>">-</button>
                                <input type="number" id="cantidad-<?php echo $carta['id']; ?>" min="1"
                                    max="<?php echo $carta['cantidad']; ?>" name="cantidad-<?php echo $carta['id']; ?>"
                                    value="1" readonly>
                                <button type="button" class="btn-mas" data-id="<?php echo $carta['id']; ?>">+</button>
                            </div>

                            <input type="hidden" value="añadirCarro" name="metodoPost">
                            <input type="hidden" name="idCarta" value="<?php echo $carta['id']; ?>">
                            <button type="submit">Añadir a carrito</button>
                        </form>
                    <?php else: ?>
                        <p>Cantidad: <?php echo htmlspecialchars($carta['cantidad']); ?></p>
                        <form>
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