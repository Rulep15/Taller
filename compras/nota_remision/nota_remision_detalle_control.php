<?php

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidnota'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];





$sql = "SELECT sp_nota_remision_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS nota_remision;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['nota_remision'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_remision'];
    header("location:nota_remision_detalle.php?vidnota=" . $_REQUEST['vidnota']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_remision_detalle.php?vidnota=" . $_REQUEST['vidnota']);
}
