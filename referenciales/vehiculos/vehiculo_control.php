<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$chapa = $_POST['vchapa'];
$chasis = $_POST['vchasis'];
$modelo = $_POST['vmodelo'];
$color = $_POST['vcolor'];
$marca = $_POST['vmarca'];


$sql = "SELECT sp_ref_vehiculo(".$operacion.",".$codigo.",'".$chapa."','".$chasis."','".$modelo."','".$color."','".$marca."') as vehiculo;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['vehiculo']==null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:vehiculo_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['vehiculo'];
    header("location:vehiculo_index.php");
}