<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidajuste'];
$fecha = $_REQUEST['vfecha'];
$usuario = $_REQUEST['vusuario'];

$sql = "SELECT sp_ajustes(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "'," .
    (!empty($usuario) ? $usuario : 0) . ") AS ajuste;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ajuste'] != NULL) {
    $valor = explode("*", $resultado[0]['ajuste']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajuste_index.php");
}
