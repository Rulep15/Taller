<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidproducto'];
$tipopro = $_REQUEST['vidtipro'];
$marca = $_REQUEST['vidmarca'];
$impuesto = $_REQUEST['vidtimp'];
$unidad = $_REQUEST['vidum'];
$descripcion = $_REQUEST['vdescripcion'];
$precioc = $_REQUEST['vprecioc'];
$preciov = $_REQUEST['vpreciov'];
$codigob = $_REQUEST['vcodigob'];

$sql = "SELECT sp_ref_producto(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($tipopro) ? $tipopro : 0) . "," .
    (!empty($marca) ? $marca : 0) . "," .
    (!empty($impuesto) ? $impuesto : 0) . "," .
    (!empty($unidad) ? $unidad : 0) . ",'" .
    (!empty($descripcion) ? $descripcion : "VACIO") . "'," .
    (!empty($precioc) ? $precioc : 0) . "," .
    (!empty($preciov) ? $preciov : 0) . "," .
    (!empty($codigob) ? $codigob : 0) . ") AS productos;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['dpedidosc'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['dpedidosc'];
    header("location:pedidosc_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosc_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
}
