<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];


$sql = "SELECT sp_ref_unidad(".$operacion.",".$codigo.",'".$nombre."') as unidad;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['unidad']==null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:unidadmedida_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['unidad'];
    header("location:unidadmedida_index.php");
}