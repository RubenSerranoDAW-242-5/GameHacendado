<?php
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

  include "../includes/pedidoExiste.php";

} else {

  include "../includes/pedidoNoExiste.php";

}
