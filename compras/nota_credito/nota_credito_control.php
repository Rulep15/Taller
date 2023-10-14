<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcredito'];
$fechasistema = $_REQUEST['vfechasis'];
$fecharecibido = $_REQUEST['vfechareci'];
$compra = $_REQUEST['vcompra'];
$motivo = $_REQUEST['vmotivo'];
$usuario = $_REQUEST['vusuario'];



$sql = "SELECT sp_nota_credito(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . ",'" .
        (!empty($fechasistema) ? $fechasistema : "01-01-0001") . "','" .
        (!empty($fecharecibido) ? $fecharecibido : "01-01-0001") . "'," .
        (!empty($compra) ? $compra : 0) . "," .
        (!empty($motivo) ? $motivo : 0) . "," .
        (!empty($usuario) ? $usuario : 0) . ") AS nota_credito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nota_credito'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_credito'];
    header("location:nota_credito_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_credito_index.php");
}
