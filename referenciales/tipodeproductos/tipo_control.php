<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];


$sql = "SELECT sp_ref_tipo(".$operacion.",".$codigo.",'".$nombre."') as tipo;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipo']==null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:tipo_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['tipo'];
    header("location:tipo_index.php");
}