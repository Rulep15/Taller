<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidgrupo'];
$nombre = $_REQUEST['vgrudescri'];

$sql = "SELECT sp_ref_grupos(" . $operacion . "," . $codigo . ",'" . $nombre . "') as grupos;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['grupos'] == NULL) {
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:grupos_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['grupos'];
    header("location:grupos_index.php");
}