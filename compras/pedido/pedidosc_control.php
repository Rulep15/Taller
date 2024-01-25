<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpedido'];
$fecha = $_REQUEST['vfecha'];
$usuario = $_REQUEST['vusuario'];
$sucur = $_REQUEST['vsucursal'];
$estado = $_REQUEST['vestado'];


$sql = "SELECT sp_compras_pedidos(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . "," .
    (!empty($sucur) ? $sucur : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
    (!empty($estado) ? $estado : "VACIO") . "') AS pedidosc;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['pedidosc'] != NULL) {
    $valor = explode("*", $resultado[0]['pedidosc']);
    // $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosc_index.php");
}
