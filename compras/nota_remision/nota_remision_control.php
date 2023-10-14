<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidremision'];
$fechainicio = $_REQUEST['vfechatranlado'];
$timbrado = $_REQUEST['vtimbrado'];
$motivo = $_REQUEST['vmotivo'];
$usuario = $_REQUEST['vusuario'];
$sucursalsalida = $_REQUEST['vsucsalida'];
$conductor = $_REQUEST['vconductor'];
$sucursaldestino = $_REQUEST['vsucursaldest'];
$vehiculo = $_REQUEST['vvehiculo'];



$sql = "SELECT sp_nota_remision(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . ",'" .
        (!empty($fechainicio) ? $fechainicio : "01-01-0001") . "','" .
        (!empty($timbrado) ? $timbrado : "0001") . "','" .
        (!empty($motivo) ? $motivo : "VACIO") . "'," .
        (!empty($usuario) ? $usuario : 0) . "," .
        (!empty($sucursalsalida) ? $sucursalsalida : 0) . "," .
        (!empty($conductor) ? $conductor : 0) . "," .
        (!empty($sucursaldestino) ? $sucursaldestino : 0) . "," .
        (!empty($vehiculo) ? $vehiculo : 0) . ") AS nota_remision;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nota_remision'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_remision'];
    header("location:nota_remision_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_remision_index.php");
}
