<?php

$bd->conectar();


$bd->conectar();

$textoBusqueda = $_POST['textoBusqueda'];

$query = "SELECT DISTINCT c.*
                          FROM Carta c
                          JOIN CategoriasCartas cc ON c.id = cc.idCarta
                          JOIN Categorias cat ON cc.idCategoria = cat.id
                          WHERE LOWER(c.nombreCarta) LIKE LOWER('%$textoBusqueda%')
                          OR LOWER(c.tipoCarta) LIKE LOWER('%$textoBusqueda%')
                          OR LOWER(c.costeCarta) LIKE LOWER('%$textoBusqueda%')
                          OR LOWER(c.color) LIKE LOWER('%$textoBusqueda%')
                          OR LOWER(c.codigoCarta) LIKE LOWER('%$textoBusqueda%')
                          OR LOWER(cat.categoria) LIKE LOWER('%$textoBusqueda%');";

$listadoCartas = $bd->querySelectMuchos($query);




$bd->desconectar();
