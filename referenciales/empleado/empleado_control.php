<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcodigo'];
$idpersona = $_REQUEST['vidpersona'];//
$idcargo = $_REQUEST['vidcargo']; //   
$idsucursal = $_REQUEST['vidsucursal'];//
$descripcion = $_REQUEST['vdescripcion'];//
$suctelefono = $_REQUEST['vsuctelefono'];//
$sucdirec = $_REQUEST['vsucdirec']; //

$sql = "SELECT sp_ref_empleado(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($idpersona) ? $idpersona:0).",".
        (!empty($idcargo) ? $idcargo:0).",".
        (!empty($idsucursal) ? $idsucursal:0).",'".
        (!empty($descripcion) ? $descripcion:"VACIO")."','".
        (!empty($suctelefono) ? $suctelefono:"VACIO")."','".
        (!empty($sucdirec) ? $sucdirec:"VACIO")."') AS empleado;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['empleado'] != NULL) {
    $valor = explode("*" , $resultado[0]['empleado']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:empleado_index.php");
}