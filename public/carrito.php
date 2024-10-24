<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>

    <link rel="stylesheet" href="../assets/css/carrito.css">
    <?php
    
    session_start();

    // include '../config/ConexionBD.php';
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
                  c.id AS carta_id, 
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
        include "../includes/eliminarCarrito.php";
    }
    ?>
</head>

<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
        <?php if (!empty($listaPedidos) && isset($_SESSION['carrito-contador'])): ?>

            <div class="pedido-detalles">
                <h4>Pedido ID: <?php echo htmlspecialchars($listaPedidos[0]['pedido_id']); ?></h4>
                <p>Precio total del pedido: <?php echo number_format($listaPedidos[0]['precioTotal'], 2); ?> €</p>
                <p>Dirección de envío: <?php echo htmlspecialchars($listaPedidos[0]['direccionEnvio']); ?></p>
            </div>
            <?php foreach ($listaPedidos as $lineaPedido): ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="linea-pedido">
                        <div class="carta-detalles">
                            <img src="<?php echo "../assets/images/" . htmlspecialchars($lineaPedido['img']); ?>"
                                alt="<?php echo htmlspecialchars($lineaPedido['nombreCarta']); ?>">
                            <div>
                                <h5><?php echo htmlspecialchars($lineaPedido['nombreCarta']); ?></h5>
                                <p>Código: <?php echo htmlspecialchars($lineaPedido['codigoCarta']); ?></p>
                                <p>Precio: <?php echo number_format($lineaPedido['precioCarta'], 2); ?> €</p>
                            </div>
                        </div>


                        <div class="linea-detalles">
                            <h5>Línea de Pedido (ID: <?php echo htmlspecialchars($lineaPedido['linea_pedido_id']); ?>)</h5>
                            <label for="cantidadSeleccionada">Cantidad:</label>
                            <select id="cantidadSeleccionada" name="cantidadSeleccionada">
                                <?php for ($i = 1; $i <= $lineaPedido['cantidad']; $i++): ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <p>Total línea: <?php echo number_format($lineaPedido['precioTotalLinea'], 2); ?> €</p>
                        </div>

                        <div>
                            <input type="hidden" name="eliminar" value="eliminar_carta">
                            <input type="hidden" name="idCarta" value="<?php echo $lineaPedido['carta_id'] ?>">
                            <input type="hidden" name="idPedido" value="<?php echo $lineaPedido['pedido_id'] ?>">
                            <input type="hidden" name="eliminarIdLineaPedido" value="<?php echo $lineaPedido['linea_pedido_id'] ?>">
                            <button type="submit" class="botonEliminarCarrito">Eliminar</button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <input type="hidden" name="eliminar" value="eliminar_pedido">
            <input type="hidden" name="idPedido" value="<?php echo $lineaPedido['pedido_id'] ?>">
            <button type="submit" class="botonVaciar">Vaciar Carrito</button>
        </div>
    </form>

    <form action="../includes/compraCarrito.php" method="get">
        <button type="submit" class="botonCompra">Comprar Ahora</button>
    </form>

    <img src="../assets/images/metodospago.png" id="imagenPago" alt="Métodos de pago">

<?php else: ?>

    <h1>Tu carrito está vacío</h1>
<?php endif; ?>
</div>

</body>
<?php include '../includes/footer.php'; ?>

</html>