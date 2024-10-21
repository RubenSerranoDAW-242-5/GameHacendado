<?php

$eliminar = $_POST['eliminar'];

switch ($eliminar) {

    case 'eliminar_carta':
        $bd->conectar();

        $idLineaPedido = $_POST['eliminarIdLineaPedido'];
        $cantidadEliminar = $_POST['cantidadSeleccionada'];

        $query = "SELECT idCarta,cantidad FROM LineaPedidos WHERE id = $idLineaPedido;";
        $resultado = $bd->querySelectUno($query);
        $idCarta = $resultado['idCarta'];

        $query = "SELECT precioCarta FROM carta WHERE id = $idCarta;";
        $carta = $bd->querySelectUno($query);
        $precioCarta = $carta['precioCarta'];

        $bd->desconectar();

        if ($resultado) {

            $cantidadlinea = $resultado['cantidad'];

            $idPedido = $_POST['idPedido'];

            

            if ($cantidadlinea !== $cantidadEliminar) {
                try{
                    $bd->conectar();

                    echo  "cantidad que hay en la linea1 ".$cantidadlinea." ";
                    echo  "cantidad que quiero eliminar1 ".$cantidadEliminar;

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
                    } else {
                        echo "Error a la hora de actulaciar la linea de pedido con id " . $idLineaPedido;
                    }
                }catch (Exception $e) {
                    echo "Error : " . $e->getMessage();
                }
            } else {

                try {
                    $bd->conectar();

                    echo  "cantidad que hay en la linea2 ".$cantidadlinea;
                    echo  "cantidad que quiero eliminar2 ".$cantidadEliminar;

                    $query = "DELETE FROM LineaPedidos WHERE id = $idLineaPedido;";
                    $resultado = $bd->queryDelete($query);

                    $query = "UPDATE Pedidos SET precioTotal = 
                          (SELECT SUM(precioTotalLinea) FROM LineaPedidos WHERE idPedido = $idPedido) 
                          WHERE id = $idPedido;";

                    $bd->queryUpdate($query);

                    $_SESSION['carrito-contador']--;

                    $bd->desconectar();

                    if ($resultado) {
                        header("Location: carrito.php");
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
        $idPedido = $_POST['pedido_id'];

        $query = "DELETE FROM Pedidos WHERE id = $idPedido;";
        $resultado = $bd->queryDelete($query);
        $bd->desconectar();
        if ($resultado) {
            header("Location: carrito.php");
        } else {
            echo "Error a la hora de vaciar el pedido con id " . $idPedido;
        }

        break;

    default:
        echo "Error a la hora de leer si eliminar carta o pedido";
        break;
}

