<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidremision'];
$timbrado = $_REQUEST['vtimbrado'];
$usuario = $_REQUEST['vusuario'];
$conductor = $_REQUEST['vconductor'];
$fecha = $_REQUEST['vfecha'];
$cedula = $_REQUEST['vcedula'];
$chapa = $_REQUEST['vchapa'];
$validez = $_REQUEST['vvalidez'];
$color = $_REQUEST['vcolor'];
$modelo = $_REQUEST['vmodelo'];
$orden = $_REQUEST['vorden'];
$factura = $_REQUEST['vnrofactura'];



$sql = "SELECT sp_nremision(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-2022") . "','" .
    (!empty($timbrado) ? $timbrado : "0001") . "','" .
    (!empty($conductor) ? $conductor : 'VACIO') . "','" .
    (!empty($cedula) ? $cedula : 'VACIO') . "','" .
    (!empty($chapa) ? $chapa : 'VACIO') . "','" .
    (!empty($color) ? $color : 'VACIO') . "','" .
    (!empty($modelo) ? $modelo : 'VACIO') . "'," .
    (!empty($orden) ? $orden : 0) . ",'" .
    (!empty($validez) ? $validez : "01-01-2022") . "','" .
    (!empty($factura) ? $factura : "0001") . "') AS nota_remision;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nota_remision'] != NULL) {
    $valor = explode("*", $resultado[0]['nota_remision']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_remision_index.php");
}
