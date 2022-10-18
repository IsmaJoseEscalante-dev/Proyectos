<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include "Config/Conexion.php";

$id = $_REQUEST['id'];

$sqlNew = "SELECT * FROM tm_imagen WHERE proy_id = $id";
$images = $conexion->query($sqlNew)->fetch_all();

foreach ($images as $image){
    $conexion->query("DELETE from tm_imagen WHERE ima_id = $image[0]");
}


$sql = "DELETE from tm_proyecto WHERE proy_id = $id";

$resultado = $conexion->query($sql);

if($resultado){
    header("Location:index.php");
}
else{
    echo "No se elimino el proyecto";
}