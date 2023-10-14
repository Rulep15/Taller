<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcompra'];
$deposito = $_REQUEST['vdeposito'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];
$subtotal = $_REQUEST['vsubtotal'];


$sql = "SELECT sp_compras_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($deposito) ? $deposito : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . "," .
    (!empty($precio) ? $precio : 0) . "," .
    (!empty($subtotal) ? $subtotal : 0) . ") AS comprasdetalles;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['comprasdetalles'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['comprasdetalles'];
    header("location:compras_detalle.php?vidcompra=" . $_REQUEST['vidcompra']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_detalle.php?vidcompra=" . $_REQUEST['vidcompra']);
}
