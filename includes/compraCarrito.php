<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Compra</title>

    <?php

    session_start();

    // include '../config/ConexionBD.php';
    include '../includes/header.php';

    if (!isset($_SESSION['gastoEnvio'])) {
        $_SESSION['gastoEnvio'] = mt_rand(1, 5);
    }

    if (isset($_SESSION['idPedido'])) {
        $idPedido = $_SESSION['idPedido'];
    } else {
        die("Error: Pedido no válido.");
    }



    $gastoEnvio = $_SESSION['gastoEnvio'];

    $bd->conectar();
    $query = "SELECT p.id AS pedido_id, 
                p.precioTotal AS total_pedido,
                p.direccionEnvio, 
                u.nombre AS nombre_cliente, 
                u.apellido AS apellido_cliente,
                u.telefono AS telefono_cliente,
                lp.cantidad,
                lp.precioTotalLinea AS total_linea, 
                c.nombreCarta, 
                c.precioCarta
         FROM 
            Pedidos p 
         JOIN 
            Usuario u ON p.idUsuario = u.id
         JOIN 
            LineaPedidos lp ON p.id = lp.idPedido 
         JOIN 
            Carta c ON lp.idCarta = c.id
         WHERE p.id = $idPedido;";

    $listaPedidos = $bd->querySelectMuchos($query);

    $bd->desconectar();

    ?>
    <link rel="stylesheet" href="../assets/css/compraCarrito.css">
</head>

<body>

    <div class="contenedor-recibo">

        <h1>Recibo de Compra</h1>
        <div class="recibo-header">
            <p><strong>Pedido No:</strong> <?php echo $listaPedidos[0]['pedido_id']; ?></p>
            <p><strong>Fecha:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>Nombre Usuario:</strong>
                <?php echo $listaPedidos[0]['nombre_cliente'] . " " . $listaPedidos[0]['apellido_cliente']; ?></p>
            <p><strong>Dirección de envío:</strong><?php echo $listaPedidos[0]['direccionEnvio'] ?></p>
        </div>

        <table class="tabla-recibo">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaPedidos as $listaLineaPedido): ?>
                    <tr>
                        <td><?php echo $listaLineaPedido['nombreCarta'] ?></td>
                        <td><?php echo $listaLineaPedido['cantidad'] ?></td>
                        <td>€<?php echo $listaLineaPedido['precioCarta'] ?></td>
                        <td>€<?php echo $listaLineaPedido['total_linea'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td>€<?php echo $listaLineaPedido['total_pedido'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Envío</strong></td>
                    <td>€<?php echo $gastoEnvio ?>,00</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td>€<?php echo $listaLineaPedido['total_pedido'] + $gastoEnvio; ?></td>
                </tr>
            </tfoot>
        </table>
        <form action="../includes/finalizarCompra.php" method="get">
            <button type="submit" class="botonFinalizarCompra">Finalizar Compra</button>
        </form>
    </div>

    <?php include "../includes/footer.php"; ?>

</body>

</html>