<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidtipoper'];
$nombre = $_REQUEST['vtipopdescri'];

$sql = "SELECT sp_ref_tipo_persona(" . $operacion . "," . $codigo . ",'" . $nombre . "') as tipopersona;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipopersona'] == NULL) {
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:tipopersona_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['tipopersona'];
    header("location:tipopersona_index.php");
}