<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpersona'];
$ciudad = $_REQUEST['vidciudad'];
$tipopersona = $_REQUEST['vtipoper'];
$nombre = $_REQUEST['vnombre'];
$apellido = $_REQUEST['vapellido'];
$ci = $_REQUEST['vci'];
$ruc = $_REQUEST['vruc'];
$direccion = $_REQUEST['vdireccion'];
$telefono = $_REQUEST['vtelefono'];
$correo = $_REQUEST['vcorreo'];
$sexo = $_REQUEST['vsexo'];
$fechanac = $_REQUEST['vfechanac'];
$razon = $_REQUEST['vrazons'];
$imagen = $_REQUEST['vimagen'];


$sql = "SELECT sp_ref_persona(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($ciudad) ? $ciudad : 0) . "," .
        (!empty($tipopersona) ? $tipopersona : 0) . ",'" .
        (!empty($nombre) ? $nombre : "VACIO") . "','" .
        (!empty($apellido) ? $apellido : "VACIO") . "','" .
        (!empty($ci) ? $ci : "VACIO") . "','" .
        (!empty($ruc) ? $ruc : "VACIO") . "','" .
        (!empty($direccion) ? $direccion : "VACIO") . "','" .
        (!empty($telefono) ? $telefono : "VACIO") . "','" .
        (!empty($correo) ? $correo : "VACIO") . "','" .
        (!empty($sexo) ? $sexo : "VACIO") . "','" .
        (!empty($fechanac) ? $fechanac : '10/05/2002') . "','" .
        (!empty($razon) ? $razon : "VACIO") . "','" .
        (!empty($imagen) ? $imagen: 0) . "') AS persona;";

$resultado = consultas::get_datos($sql);




if ($resultado[0]['persona'] != NULL) {
    $valor = explode("*" , $resultado[0]['persona']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:persona_index.php");
}

?>

