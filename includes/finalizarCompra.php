<?php

session_start();
include '../config/ConexionBD.php';

$idPedido = $_SESSION['idPedido'];
$bd->conectar();

$query = "SELECT idCarta,cantidad FROM LineaPedidos WHERE idPedido = $idPedido;";
$resultado = $bd->querySelectMuchos($query);

foreach ($resultado as $carta) {

    $cartasPedido = $carta['idCarta'];
    $cantidadCartasPedido = $carta['cantidad'];

    $query = "UPDATE carta SET cantidad = cantidad - $cantidadCartasPedido WHERE id = $cartasPedido";
    $bd->queryUpdate($query);
}

$query = "UPDATE Pedidos SET estado = 'terminado',fecha = NOW() WHERE id = $idPedido;";
$bd->queryUpdate($query);

$query = "DELETE FROM LineaPedidos WHERE idPedido = $idPedido;";
$bd->queryUpdate($query);

$bd->desconectar();

$_SESSION['gastoEnvio'] = 0;
$_SESSION['carrito-contador'] = 0;
unset($_SESSION['idPedido']);

header("Location: ../public/index.php");
exit;