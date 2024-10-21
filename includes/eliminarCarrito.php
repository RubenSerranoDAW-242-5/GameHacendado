<?php

$eliminar = $_POST['eliminar'];

switch ($eliminar) {

    case 'eliminar_carta':
        $bd->conectar();

        $idLineaPedido = $_POST['eliminarIdLineaPedido'];
        $cantidadEliminar = $_POST['cantidadSeleccionada'];
        $idCarta = $_POST['idCarta'];
        $idPedido = $_POST['idPedido'];

        $query = "SELECT cantidad FROM LineaPedidos WHERE id = $idLineaPedido;";
        $resultado = $bd->querySelectUno($query);
        

        $query = "SELECT precioCarta FROM carta WHERE id = $idCarta;";
        $carta = $bd->querySelectUno($query);
        $precioCarta = $carta['precioCarta'];

        $bd->desconectar();

        if ($resultado) {

            $cantidadlinea = $resultado['cantidad'];

            if ($cantidadlinea !== $cantidadEliminar) {
                try {
                    $bd->conectar();

                    $restoCantidad = $cantidadlinea - $cantidadEliminar;

                    $query = "UPDATE LineaPedidos
                              SET cantidad = $restoCantidad 
                              WHERE id = $idLineaPedido;";
                    $resultado = $bd->queryUpdate($query);

                    $query = "UPDATE LineaPedidos 
                    SET precioTotalLinea = cantidad *  $precioCarta
                    WHERE idCarta = $idCarta;";
                    $bd->queryUpdate($query);

                    $query = "UPDATE Pedidos SET precioTotal = 
                    (SELECT SUM(precioTotalLinea) FROM LineaPedidos WHERE idPedido = $idPedido) 
                    WHERE id = $idPedido;";
                    $bd->queryUpdate($query);

                    $bd->desconectar();

                    if ($resultado) {
                        header("Location: carrito.php");
                        exit();
                    } else {
                        echo "Error a la hora de actulaciar la linea de pedido con id " . $idLineaPedido;
                    }
                } catch (Exception $e) {
                    echo "Error : " . $e->getMessage();
                }
            } else {

                try {
                    $bd->conectar();

                    $query = "DELETE FROM LineaPedidos WHERE id = $idLineaPedido;";
                    $resultado = $bd->queryDelete($query);

                    $query = "UPDATE Pedidos SET precioTotal = 
                          (SELECT SUM(precioTotalLinea) FROM LineaPedidos WHERE idPedido = $idPedido) 
                          WHERE id = $idPedido;";

                    $bd->queryUpdate($query);

                    $bd->desconectar();

                    if ($resultado) {
                        $_SESSION['carrito-contador']--;
                        header("Location: carrito.php");
                        exit();
                    } else {
                        echo "Error a la hora de eliminar la linea de pedido con id " . $idLineaPedido;
                    }
                } catch (Exception $e) {
                    echo "Error al insertar: " . $e->getMessage();
                }
            }
        }

        break;
    case 'eliminar_pedido':
        $bd->conectar();

        $idPedido = $_POST['idPedido'];

        $query = "DELETE FROM LineaPedidos WHERE idPedido = $idPedido;";
        $bd->queryDelete($query);

        $query = "DELETE FROM Pedidos WHERE id = $idPedido;";
        $resultado = $bd->queryDelete($query);
        $bd->desconectar();

        $_SESSION['carrito-contador'] = 0;

        if ($resultado) {
            header("Location: carrito.php");
            exit();
        } else {
            echo "Error a la hora de vaciar el pedido con id " . $idPedido;
        }

        break;

    default:
        echo "Error a la hora de leer si eliminar carta o pedido";
        break;
}
