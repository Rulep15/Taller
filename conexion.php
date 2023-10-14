<?php

class conexion
{

    public static function con()
    {
        $cadena = "host='localhost'" . "port='5432'" . "dbname='TA'" . "user='postgres'" . "password='123'";
        $con = pg_connect($cadena) or die("Error de conexion" . pg_last_error());
        return $con;
    }
}

class consultas extends conexion
{

    public static function get_datos($sql)
    {
        $res = pg_query(parent::con(), $sql) or die($sql . '<br>' . utf8_decode(pg_last_error()));
        if (isset($res)) {
            while ($reg = pg_fetch_assoc($res)) {
                $t[] = $reg;
            }
            if (isset($t)) {
                return $t;
            } else {
                return null;
            }
        }
    }

    public static function ejecutar_sql($sql)
    {
        if (pg_query(parent::con(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
