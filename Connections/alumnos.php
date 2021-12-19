<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_alumnos = "localhost";
$database_alumnos = "usuarios";
$username_alumnos = "admin";
$password_alumnos = "root";
$alumnos = mysql_pconnect($hostname_alumnos, $username_alumnos, $password_alumnos) or trigger_error(mysql_error(),E_USER_ERROR); 

if (!$alumnos)
{
    $conexion = "No se ha podido encontrar la Tabla";
}
else
{
    $conexion = "Conectado a la base de datos $database_alumnos" ;
};

?>