<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['operacion'];
$codigo = $_REQUEST['vidservicio'];
$usuario = $_REQUEST['vusuario'];
$fecha = $_REQUEST['vfecha'];
$descri = $_REQUEST['vdescri'];
$estado = $_REQUEST['vestado'];


$sql = "SELECT sp_servicios(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
    (!empty($descri) ? $descri : "VACIO") . "','" .
    (!empty($estado) ? $estado : "VACIO") . "') AS servicios;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['servicios'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['servicios'];
    header("location:servicios_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:servicios_index.php");
}
