<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$ciudad = $_REQUEST['vciudad'];
$razon = $_REQUEST['vrazon'];
$ruc = $_REQUEST['vruc'];
$telefono = $_REQUEST['vtelefono'];
$direccion = $_REQUEST['vdireccion'];

$sql = "SELECT sp_ref_proveedor(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",".
        (!empty($ciudad) ? $ciudad:0).",'".
        (!empty($razon) ? $razon:0)."','".
        (!empty($ruc) ? $ruc:0)."','".
        (!empty($telefono) ? $telefono:0)."','".
        (!empty($direccion) ? $direccion:0)."') AS proveedor;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['proveedor'] != NULL) {
    $valor = explode("*" , $resultado[0]['proveedor']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:proveedor_index.php");
}
