<?php

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$rol = $_POST['rol'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$bd->conectar();

$query = "UPDATE Usuario
                  SET 
                    nombre = '$nombre', 
                    apellido = '$apellido', 
                    email = '$email', 
                    dni = '$dni', 
                    rol = '$rol', 
                    direccion = '$direccion', 
                    telefono = '$telefono'
                  WHERE id = '$id';";


$resultado = $bd->queryUpdate($query);

if ($resultado) {

  header("Location: ../admin/zonaUsuarios.php");
  exit;
} else {
  echo "Error al hacer el update";
}

$bd->desconectar();
