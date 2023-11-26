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
$pedi = $_REQUEST['vidpedido'];
$codigob = $_REQUEST['vcodigob'];



$sql = "SELECT sp_ref_detcomp_producto(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($tipopro) ? $tipopro : 0) . "," .
    (!empty($marca) ? $marca : 0) . "," .
    (!empty($impuesto) ? $impuesto : 0) . "," .
    (!empty($unidad) ? $unidad : 0) . ",'" .
    (!empty($descripcion) ? $descripcion : "VACIO") . "'," .
    (!empty($precioc) ? $precioc : 0) . "," .
    (!empty($preciov) ? $preciov : 0) . "," .
    (!empty($pedi) ? $pedi : 0) . "," .
    (!empty($codigob) ? $codigob : 0) . ") AS productos;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['productos'] != NULL) {
    $valor = explode("*", $resultado[0]['productos']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_detalle.php");
}
