<?php
if (
    isset($_POST["nombre"]) && isset($_POST["apellido"]) &&
    isset($_POST["email"]) && isset($_POST["dni"]) && isset($_POST["direccion"]) && isset($_POST["telefono"])
    && isset($_POST['contra']) && isset($_POST['confirmacion_contra'])
) {
    if ($_POST['contra'] == $_POST['confirmacion_contra']) {

        $dni = $_POST['dni'];
        $queryDni = "SELECT * FROM Usuario WHERE dni = '$dni'LIMIT 1;";
        $bd->conectar();
        $resdni = $bd->querySelectUno($queryDni);
        $bd->desconectar();

        if (!$resdni) {

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $contra = $_POST['contra'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            $query = "INSERT INTO Usuario (nombre, apellido, email, dni, contraseña, rol, direccion, telefono)
                    VALUES ('$nombre','$apellido','$email','$dni','$contra','usuario','$direccion','$telefono')";
            $bd->conectar();
            $res = $bd->queryInsert($query);
            $bd->desconectar();

            if ($res) {
                include "../phpMailer/Correo.php";
                EnviarCorreo($email,$nombre);
            } else {
                $errorMessage = "Error insert en la base de datos";
            }
        } else {
            $errorMessage = "El dni ya esta en uso";
        }
    } else {
        $errorMessage = "La contraseña no es la misma";
    }
} else {
    $errorMessage = "Tienes algun campo sin rellenar";
}
