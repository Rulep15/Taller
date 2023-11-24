<?php

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vidmarca'];
$pedi = $_REQUEST['vidpedido'];
$nombre = $_POST['vdescripcionmarca']; //tambien se puede usar request

$sql = "SELECT sp_ref_marca_det_pedido(" . $operacion . "," . $codigo . "," . $pedi . ",'" . $nombre . "') as marca;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['marca'] != NULL) {
    $valor = explode("*", $resultado[0]['marca']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosc_index.php");
}
