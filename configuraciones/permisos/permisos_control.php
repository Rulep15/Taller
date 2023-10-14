<?php

require '../../conexion.php';
session_start();

$pagina = $_REQUEST['vpag'];
$grupo = $_REQUEST['vgru'];
$leer = $_REQUEST['consul'];
$insert = $_REQUEST['agre'];
$edit = $_REQUEST['editar'];
$delete = $_REQUEST['borrar'];
$user = $_SESSION['usu_nick'];
$operacion = $_REQUEST['accion'];

$sql = "SELECT sp_ref_permisos(" . $pagina . "," . $grupo . "," .
        $leer . "," . $insert . "," . $edit . "," . $delete . ",'" . $user . "'," .
        $operacion . ") as permisos;";

$resultado = consultas::get_datos($sql);
if ($resultado[0]['permisos'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['permisos'];
    header('location:./' . $_REQUEST['pagina'] . "?vgrup=" . $_REQUEST['vgru'] .
            '&vgrunombre=' . $_REQUEST['vgrunombre']);
}
?>

