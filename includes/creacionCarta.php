<?php 
$bd->conectar();

$nombreCarta = $_POST['nombreCarta'];
$tipoCarta = $_POST['tipoCarta'];
$costeCarta = $_POST['costeCarta'];
$codigoCarta = $_POST['codigoCarta'];
$colorCarta = $_POST['color'];
$precioCarta = $_POST['precioCarta'];
$imagenNombre = $_FILES['img']['name'];
$categoriasSeleccionadas = isset($_POST['categorias']) ? $_POST['categorias'] : [];
$cantidadCartas = $_POST['cantidad'];

$query = "INSERT INTO Carta(nombreCarta, tipoCarta, costeCarta, color, codigoCarta, precioCarta, img, cantidad) VALUES 
                ('$nombreCarta','$tipoCarta','$costeCarta','$colorCarta','$codigoCarta',$precioCarta,'$imagenNombre',$cantidadCartas);";

$bd->queryInsert($query);

$idCarta = $bd->lastInsertId();
$imagenArchivo = $_FILES['img']['tmp_name'];
move_uploaded_file($imagenArchivo, "../assets/images/" . $imagenNombre);

foreach ($categoriasSeleccionadas as $id) {
    $query = "INSERT INTO CategoriasCartas(idCarta,idCategoria) VALUES 
($idCarta,$id);";

    $bd->queryInsert($query);
}
$bd->desconectar();

header("Location: ../admin/zonaCartas.php");