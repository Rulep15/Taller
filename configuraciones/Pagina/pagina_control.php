<?php
    require '../../conexion.php';
    session_start();
    
    $operacion = $_REQUEST['voperacion'];
    $codigo = $_REQUEST['vpagina'];
    $direccion = $_REQUEST['vdireccion'];
    $nombre = $_REQUEST['vnombre'];
    $modulo = $_REQUEST['vmodulo'];
    
    
    $sql = "SELECT sp_ref_pagina(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",'".
        (!empty($direccion) ? $direccion:"VACIO")."','".
        (!empty($nombre) ? $nombre:"VACIO")."',".
        (!empty($modulo) ? $modulo:0).") AS paginas;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['paginas'] != NULL) {
    $valor = explode("*" , $resultado[0]['paginas']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pagina_index.php");
}
?>
