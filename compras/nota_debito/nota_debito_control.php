<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['videbito'];
$fechasistema = $_REQUEST['vfechasis'];
$fecharecibido = $_REQUEST['vfechareci'];
$compra = $_REQUEST['vcompra'];
$usuario = $_REQUEST['vusuario'];



$sql = "SELECT sp_nota_debito(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . ",'" .
        (!empty($fechasistema) ? $fechasistema : "01-01-0001") . "','" .
        (!empty($fecharecibido) ? $fecharecibido : "01-01-0001") . "'," .
        (!empty($compra) ? $compra : 0) . "," .
        (!empty($usuario) ? $usuario : 0) . ") AS nota_debito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nota_debito'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nota_debito'];
    header("location:nota_debito_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nota_debito_index.php");
}
