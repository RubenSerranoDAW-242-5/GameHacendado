<?php

class conexionBD
{
    private $conBd;
    public function conectar()
    {
        $this->conBd = new mysqli("localhost", "root", "", "bd_gamehacendado");
        if ($this->conBd->connect_error) {
            die("Conexión fallida: " . $this->conBd->connect_error);
        }
    }
    public function desconectar()
    {
        $this->conBd->close();
    }
    function querySelectUno($query)
    {
        $resultado = $this->conBd->query($query);
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        }else{
            return false;
        }
    }
    function querySelectMuchos($query)
    {
        $resultado = $this->conBd->query($query);
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }
    function queryInsert($query)
    {
        $resultado = $this->conBd->query($query);
        return $resultado;
    }
    function queryDelete($query)
    {
        $resultado = $this->conBd->query($query);
        if ($resultado) {
            return true;
        } else
            return false;
    }
    function queryUpdate($query)
    {
        $resultado = $this->conBd->query($query);
        if ($resultado) {
            return true;
        } else
            return false;
    }
    function lastInsertId() {
        return $this->conBd->lastInsertId();
    }
}

$bd = new conexionBD();


?>