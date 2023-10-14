<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vidpresupuesto'];
$producto = $_REQUEST['vproducto'];//
$deposito = $_REQUEST['vdeposito']; //
$cantidad = $_REQUEST['vcantidad'];//
$precio = $_REQUEST['vprecio'];

 $idpedido = $_REQUEST['vidpedido'];

$sql = "SELECT sp_presupuesto_detalle(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).",".
        (!empty($precio) ? $precio:0).") AS presup;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['presup'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['presup'];
    header("location:presupuesto_detalle.php?vidpresupuesto=". $_REQUEST['vidpresupuesto']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:presupuesto_detalle.php?vidpresupuesto=" .$_REQUEST['vidpresupuesto']);
}