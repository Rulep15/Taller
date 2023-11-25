<?php

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidorden'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];


$sql = "SELECT sp_ordenc_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS orden;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['orden'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['orden'];
    header("location:ordenc_detalle.php?vidorden=" . $_REQUEST['vidorden']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ordenc_detalle.php?vidorden=" . $_REQUEST['vidorden']);
}
