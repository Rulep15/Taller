<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];


$sql = "SELECT sp_ref_marca(".$operacion.",".$codigo.",'".$nombre."') as marca;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['marca']==null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:marca_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['marca'];
    header("location:marca_index.php");
}