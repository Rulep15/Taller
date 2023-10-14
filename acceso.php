<?php

session_start();
require './conexion.php';
$user = $_POST['usuario'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM v_ref_usuario WHERE usu_nick='" . $user . "' AND usu_clave = md5('" . $pass . "')";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['usu_cod'] == NULL) {
    $_SESSION['error'] = 'USUARIO O CONTRASEÑA INCORRECTOS';
    header('location:index.php');
} else {
    $_SESSION['usu_cod'] = $resultado[0]['usu_cod'];
    $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
    $_SESSION['usu_foto'] = $resultado[0]['usu_foto'];
    $_SESSION['emp_cod'] = $resultado[0]['emp_cod'];
    $_SESSION['nombres'] = $resultado[0]['persona'];
    $_SESSION['car_descri'] = $resultado[0]['car_descri'];
    $_SESSION['gru_cod'] = $resultado[0]['gru_cod'];
    $_SESSION['gru_nombre'] = $resultado[0]['gru_nombre'];
    $_SESSION['id_sucursal'] = $resultado[0]['id_sucursal'];
    $_SESSION['suc_descri'] = $resultado[0]['suc_descri'];

    header('location:menu.php');
}
