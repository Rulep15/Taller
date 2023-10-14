<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpedido'];
$deposito = $_REQUEST['vdeposito'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];


$sql = "SELECT sp_compras_pedidos_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($deposito) ? $deposito : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . "," .
    (!empty($precio) ? $precio : 0) . ") AS dpedidosc;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['dpedidosc'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['dpedidosc'];
    header("location:pedidosc_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosc_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
}
