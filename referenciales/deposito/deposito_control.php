<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$sucursal = $_REQUEST['vidsucursal'];
$descripcion = $_REQUEST['vdescripcion'];

$sql = "SELECT sp_ref_deposito(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",'".
        (!empty($sucursal) ? $sucursal:0)."','".
        (!empty($descripcion) ? $descripcion:0)."') AS desposito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['desposito'] != NULL) {
    $valor = explode("*" , $resultado[0]['desposito']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:desposito_index.php");
}
