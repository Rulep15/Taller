<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidciudad'];
$pais = $_REQUEST['vidpais'];
$descripcion = $_REQUEST['vciudescri'];


$sql = "SELECT sp_ref_ciudad(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($pais) ? $pais : 0) . ",'" .
        (!empty($descripcion) ? $descripcion : "VACIO") . "') AS ciudad;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ciudad'] != NULL) {
    $valor = explode("*" , $resultado[0]['ciudad']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ciudad_index.php");
}

?>

