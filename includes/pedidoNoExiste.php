<?php
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