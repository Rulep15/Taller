<?php 

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidnota'];
$motivo = $_REQUEST['vidmotivo'];
$precio = $_REQUEST['vprecio'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito']; 
$cantidad = $_REQUEST['vcantidad'];





$sql = "SELECT sp_nota_debito_detalle(" . $operacion . ",".
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($motivo) ? $motivo : 0) . "," .
        (!empty($precio) ? $precio : 0) . "," .
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).") AS nota_debito;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['nota_debito'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_debito'];
    header("location:nota_debito_detalle.php?vidnota=". $_REQUEST['vidnota']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_debito_detalle.php?vidnota=" .$_REQUEST['vidnota']);
}