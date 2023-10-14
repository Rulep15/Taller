<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];


$sql = "SELECT sp_ref_pais(".$operacion.",".$codigo.",'".$nombre."') as pais;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['pais']==null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:pais_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['pais'];
    header("location:pais_index.php");
}