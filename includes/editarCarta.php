<?php

$bd->conectar();


$nombreCarta = $_POST['nombreCarta'];
$tipoCarta = $_POST['tipoCarta'];
$costeCarta = $_POST['costeCarta'];
$colorCarta = $_POST['color'];
$codigoarta = $_POST['codigoCarta'];
$precioCarta = $_POST['precioCarta'];
$idEditar = $_POST['id'];

$query = "UPDATE Carta 
          SET 
              nombreCarta = '$nombreCarta', 
              tipoCarta = '$tipoCarta', 
              costeCarta = '$costeCarta', 
              color = '$colorCarta', 
              codigoCarta = '$codigoarta', 
              precioCarta = $precioCarta
          WHERE id = $idEditar";

$resultado = $bd->queryUpdate($query);

if ($resultado) {

    header("Location: ../admin/zonaCartas.php");
    exit;
} else {

    echo "Error al hacer el update";
}

$bd->desconectar();
