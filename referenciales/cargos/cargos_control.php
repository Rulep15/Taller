<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcargo'];
$descripcion = $_REQUEST['vcardescri'];

$sql = "SELECT sp_ref_cargos(" . $operacion . "," . $codigo . ",'" . $descripcion . "') as cargos;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['cargos'] == NULL) {
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:cargos_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['cargos'];
    header("location:cargos_index.php");
}