<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidtimp'];
$descri = $_REQUEST['vtdescripcion'];
$porcent = $_REQUEST['vporcentaje'];

$sql = "SELECT sp_ref_tipo_impuesto(" . $operacion . "," . $codigo . ",'" . $descri . "'," .$porcent. ") as tipo_impuesto;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipo_impuesto'] == NULL) {
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:tipo_de_impuesto_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['tipo_impuesto'];
    header("location:tipo_de_impuesto_index.php");
}