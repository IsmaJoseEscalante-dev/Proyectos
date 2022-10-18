<?php

$server = "localhost";
$user = "root";
$pass = "";
$db="proyectos";

$conexion = mysqli_connect($server,$user,$pass, $db);

if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
    die;
}