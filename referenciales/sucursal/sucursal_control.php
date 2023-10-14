<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$ciudad = $_REQUEST['vciudad'];
$sucursal = $_REQUEST['vsucursal'];
$telefono = $_REQUEST['vtelefono'];
$direccion = $_REQUEST['vdireccion'];

$sql = "SELECT sp_ref_sucursal(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",".
        (!empty($ciudad) ? $ciudad:0).",'".
        (!empty($sucursal) ? $sucursal:0)."','".
        (!empty($telefono) ? $telefono:0)."','".
        (!empty($direccion) ? $direccion:0)."') AS sucursal;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sucursal'] != NULL) {
    $valor = explode("*" , $resultado[0]['sucursal']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:sucursal_index.php");
}
