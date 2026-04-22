<?php

$host = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "sit_db";

$conexion = mysqli_connect($host, $usuario, $clave, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
