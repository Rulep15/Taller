<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidajuste'];
$producto = $_REQUEST['vproducto'];
$motivo = $_REQUEST['vmotivo'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];


$sql = "SELECT sp_ajuste_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($motivo) ? $motivo : 0) . "," .
    (!empty($deposito) ? $deposito : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS ajustes;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ajustes'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['ajustes'];
    header("location:ajuste_detalle.php?vidajuste=" . $_REQUEST['vidajuste']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajuste_detalle.php?vidajuste=" . $_REQUEST['vidajuste']);
}
