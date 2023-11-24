<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vidtipo'];
$pedi = $_REQUEST['vidpedido'];
$nombre = $_POST['vdescripcionproducto'];


$sql = "SELECT sp_ref_det_tipo(" . $operacion . "," . $codigo . "," . $pedi . ",'" . $nombre . "') as tipo;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipo'] != NULL) {
    $valor = explode("*", $resultado[0]['tipo']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosc_index.php");
}
