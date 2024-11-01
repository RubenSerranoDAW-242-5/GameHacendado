<?php

$usuarioEmail = $_POST['usuario'];
$contra = $_POST['contra'];

$query = "SELECT id,email,contraseña,rol FROM Usuario WHERE email='$usuarioEmail' LIMIT 1";

$resultado = $bd->querySelectUno($query);
if ($resultado['contraseña'] == $contra && $resultado['email'] == $usuarioEmail) {

    $_SESSION['email'] = $resultado['email'];
    $_SESSION['id'] = (int) $resultado['id'];
    $_SESSION['rol'] = $resultado['rol'];
    $idUsuario = $_SESSION['id'];
    $query = "SELECT COUNT(lp.id) AS numero_lineas_pedido
              FROM Pedidos p
              JOIN LineaPedidos lp ON p.id = lp.idPedido
              WHERE p.idUsuario = $idUsuario;";
    $bd->conectar();
    $reslutado = $bd->querySelectUno($query);
    $bd->desconectar();
    if ($reslutado) {
        $_SESSION['carrito-contador'] = (int) $reslutado['numero_lineas_pedido'];
    } else {
        $_SESSION['carrito-contador'] = 0;
    }

    header("Location: ../public/index.php");
    $bd->desconectar();
    exit;

} else if ($resultado['contraseña'] != $contra || $resultado['email'] != $usuario) {
    $errorMessage = "Usuario o Contraseña son incorrectos";
}