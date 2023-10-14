<?php 

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidnota'];
$precio = $_REQUEST['vprecio'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito']; 
$cantidad = $_REQUEST['vcantidad'];





$sql = "SELECT sp_nota_credito_detalle(" . $operacion . ",".
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($precio) ? $precio : 0) . "," .
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).") AS nota_credito;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['nota_credito'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_credito'];
    header("location:nota_credito_detalle.php?vidnota=". $_REQUEST['vidnota']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_credito_detalle.php?vidnota=" .$_REQUEST['vidnota']);
}