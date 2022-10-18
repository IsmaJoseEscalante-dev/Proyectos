<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include "Config/Conexion.php";

$id = $_REQUEST['id'];

$image = $conexion->query("SELECT * FROM tm_imagen WHERE ima_id = $id")->fetch_assoc();
$resultado = $conexion->query("DELETE from tm_imagen WHERE ima_id = $id");

if($resultado){
    header("Location:Editar.php?id=".$image['proy_id']);
}
else{
    echo "No se elimino la imagen";
}