<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>

    <link rel="stylesheet" href="../assets/css/carrito.css">
    <?php
    session_start();

    include '../config/ConexionBD.php';
    include '../includes/header.php';
    if (isset($_SESSION['id'])) {
        $bd->conectar();
        $idUsuario = $_SESSION["id"];
        $query = "SELECT p.id AS pedido_id, 
                  p.fecha, 
                  p.precioTotal, 
                  p.direccionEnvio, 
                  lp.id AS linea_pedido_id, 
                  lp.cantidad, 
                  lp.precioTotalLinea, 
                  c.nombreCarta, 
                  c.precioCarta,
                  c.codigoCarta,
                  c.img
                  FROM Pedidos p 
                  JOIN Carta c
                  JOIN LineaPedidos lp ON p.id = lp.idPedido AND lp.idCarta = c.id
                  WHERE p.idUsuario = $idUsuario;";
        $listaPedidos = $bd->querySelectMuchos($query);

        $bd->desconectar();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // cambiar estado del  pedido a terminado y actulizar datos como envio etc
    }
    ?>
</head>

<body>
    <div class="container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h1>Carrito de Compras</h1>
        <?php foreach ($listaPedidos as $lineaPedido): ?>
            <div class="linea-pedido">

                <div class="pedido-detalles">
                    <h4>Pedido ID: <?php echo htmlspecialchars($lineaPedido['pedido_id']); ?></h4>
                    <p>Fecha: <?php echo htmlspecialchars($lineaPedido['fecha']); ?></p>
                    <p>Precio total del pedido: <?php echo number_format($lineaPedido['precioTotal'], 2); ?> €</p>
                    <p>Dirección de envío: <?php echo htmlspecialchars($lineaPedido['direccionEnvio']); ?></p>
                </div>

                <div class="carta-detalles">
                    <h5>Carta: <?php echo htmlspecialchars($lineaPedido['nombreCarta']); ?></h5>
                    <img src="<?php echo "../assets/images/" . htmlspecialchars($lineaPedido['img']); ?>" alt="<?php echo htmlspecialchars($lineaPedido['nombreCarta']); ?>" class="carta-img">
                    <p>Código: <?php echo htmlspecialchars($lineaPedido['codigoCarta']); ?></p>
                    <p>Precio de la carta: <?php echo number_format($lineaPedido['precioCarta'], 2); ?> €</p>
                </div>

                <div class="linea-detalles">
                    <h5>Detalles de la línea de pedido (ID: <?php echo htmlspecialchars($lineaPedido['linea_pedido_id']); ?>)</h5>
                    <label for="cantidadSeleccionada">Cantidad:</label>
                    <select id="cantidadSeleccionada">
                        <?php for ($i = 0; $i <= $lineaPedido['cantidad']; $i++): ?>
                            <option><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <p>Precio total de la línea: <?php echo number_format($lineaPedido['precioTotalLinea'], 2); ?> €</p>
                </div>
                <button class="botonEliminarCarrito" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">Eliminar Carrito</button>
                <hr>
            </div>
        <?php endforeach; ?>

        <hr>
    </div>
    <button type="submit" class="botonCompra">Comprar Ahora</button>
    <img src="../assets/images/metodospago.png" id="imagenPago" alt="img-pagos">
    </div>

</body>
<?php include '../includes/footer.php'; ?>

</html>