<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$dataBase = "cms_portafolio";

$conexion = new mysqli($host, $usuario, $contraseña, $dataBase);

if ($conexion->connect_error) {
    die("FALLO EN LA CONEXION: " . $conexion->connect_error);
}
?>
