<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcompra'];
$sucursal = $_REQUEST['vsucursal'];
$usuario = $_REQUEST['vusuario'];
$proveedor = $_REQUEST['vidproveedor'];
$nrofactura = $_REQUEST['vnrofactura'];
$timbrado = $_REQUEST['vtimbrado'];
$fecha = $_REQUEST['vfecha'];
$condicion = $_REQUEST['vcondicion'];
$canticuo = $_REQUEST['vcantidadcuota'];
$intervalo = $_REQUEST['vintervalo'];
$validez = $_REQUEST['vvalidez'];
$orden = $_REQUEST['vordenes'];






$sql = "SELECT sp_compras(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($sucursal) ? $sucursal : 0) . "," .
        (!empty($usuario) ? $usuario : 0) . "," .
        (!empty($proveedor) ? $proveedor : 0) . ",'" .
        (!empty($nrofactura) ? $nrofactura : "VACIO") . "'," .
        (!empty($timbrado) ? $timbrado : 0) . ",'" .
        (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
        (!empty($condicion) ? $condicion : "VACIO") . "'," .
        (!empty($canticuo) ? $canticuo : 0) . "," .
        (!empty($intervalo) ? $intervalo : 0) . ",'" .
        (!empty($validez) ? $validez : "01-01-0001") . "'," .
        (!empty($orden) ? $orden : 0) . ") AS compras;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['compras'] != NULL) {
    $valor = explode("*", $resultado[0]['compras']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_index.php");
}
