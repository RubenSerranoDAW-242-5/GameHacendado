<?php

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