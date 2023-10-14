<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidajuste'];
$fecha = $_REQUEST['vfecha'];
$ajuste = $_REQUEST['vajustes'];
$deposito = $_REQUEST['vdeposito'];
$producto = $_REQUEST['vproducto'];
$usuario = $_REQUEST['vusuario'];
$cantidad = $_REQUEST['vcantidad'];

$sql = "SELECT sp_ajuste(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . ",'" .
        (!empty($fecha) ? $fecha : "01-01-0001") . "'," .
        (!empty($ajuste) ? $ajuste : 0) . "," .
        (!empty($deposito) ? $deposito : 0) . "," .
        (!empty($producto) ? $producto : 0) . "," .
        (!empty($usuario) ? $usuario : 0) . "," .
        (!empty($cantidad) ? $cantidad : 0) . ") AS ajuste;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ajuste'] != NULL) {
    $valor = explode("*", $resultado[0]['ajuste']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajuste_index.php");
}
?>

