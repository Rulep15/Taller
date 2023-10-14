<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vusucod'];
$nick = $_REQUEST['vnick'];
$clave = $_REQUEST['vclave'];
$sucursal = $_REQUEST['vidsucursal'];
$empleado = $_REQUEST['vidempleado'];
$grupo = $_REQUEST['vgrucod'];
$imagen = $_REQUEST['vimagen'];

$sql = "SELECT sp_ref_usuario(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",'".
        (!empty($nick) ? $nick:0)."','".
        (!empty($clave) ? $clave:0)."',".
        (!empty($sucursal) ? $sucursal:0).",".
        (!empty($empleado) ? $empleado:0).",".
        (!empty($grupo) ? $grupo:0).",'".
        (!empty($imagen) ? $imagen:0)."') AS usuario;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuario'] != NULL) {
    $valor = explode("*" , $resultado[0]['usuario']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:usuario_index.php");
}
