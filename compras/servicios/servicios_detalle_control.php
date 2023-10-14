<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidservicio'];
$chofer = $_REQUEST['vchofer'];
$servicio = $_REQUEST['vservicio'];
$monto = $_REQUEST['vmonto'];


$sql = "SELECT sp_servicios_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($chofer) ? $chofer : 0) . ",'" .
    (!empty($servicio) ? $servicio : "VACIO") . "'," .
    (!empty($monto) ? $monto : 0) . ") AS serviciosp;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['serviciosp'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['serviciosp'];
    header("location:servicios_detalle.php?vidservicio=" . $_REQUEST['vidservicio']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:servicios_detalle.php?vidservicio=" . $_REQUEST['vidservicio']);
}
