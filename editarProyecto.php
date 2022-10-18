<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "Config/Conexion.php";



$j = 0;     // Variable for indexing uploaded image.
$target_path = "uploads/";     // Declaring Path for uploaded images.

$stmt = mysqli_prepare($conexion, "UPDATE  tm_proyecto SET proy_nom=?,proy_desc=? WHERE proy_id = {$_POST['proy_id']}");
// ss por que son 2 string
mysqli_stmt_bind_param($stmt, 'ss', $proy_nom, $proy_desc);

// validamos que se enviaron los campos

$proy_nom = isset($_POST['proy_nom']) ? $_POST['proy_nom'] : 0;
$proy_desc = isset($_POST['proy_desc']) ?  $_POST['proy_desc'] : 0 ;
// esto es igual a un if else
// expresion_a_evaluar ? si_es_true : si_no_else;


/* ejecuta sentencias preparadas */
mysqli_stmt_execute($stmt);

printf("%d Fila insertada.\n", mysqli_stmt_affected_rows($stmt));
printf("%d Fila insertada.\n", $stmt->insert_id);

// validamos que no sea alguan 0
if ( !$proy_nom || !$proy_desc){
  // finalizamos la ejecucion
  die("uno o ambos parametro sin definir!");
}

$proy_id = $_POST['proy_id'];
$total = count($_FILES['image']['name']);

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

    //Get the temp file path
    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
  
    //Make sure we have a file path
    if ($tmpFilePath != ""){
        //Setup our new file path
        $nuevo_nombre = getUniqueName(end(explode(".", $_FILES['image']['name'][$i])));
        $newFilePath = "uploads/" .  $nuevo_nombre;
  
        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
    
            //Handle other code here
            $stmtImagen = mysqli_prepare($conexion, "INSERT INTO tm_imagen(ima_path, proy_id) VALUES(?, ?)");
  
            // validamos que se enviaron los campos
            $ima_path = $newFilePath ;
            
            mysqli_stmt_bind_param($stmtImagen, 'sd', $ima_path , $proy_id );
            /* ejecuta sentencias preparadas */
            mysqli_stmt_execute($stmtImagen);
        }
    }
  }

function getUniqueName($extension = 'jpg'){
  switch ($extension) {
      case 'jpg':
      case 'jpeg':
          $extension = 'jpg';
          break;
      case 'png':
          $extension = 'png';
          break;
      case 'gif':
          $extension = 'gif';
          break;
  }
  date_default_timezone_set('UTC');
  $name = "img_";
  $name.= date("YmdHis");
  $name.= substr(md5(rand(0, PHP_INT_MAX)), 10);
  $name.= ".".$extension;
  return $name;
}

// si ambos estan definidos
// continuamos con la ejecucion

//$sql = "INSERT INTO tm_proyecto (proy_nom,proy_desc) VALUES ($proy_nom, $proy_desc)";

//$resultado = mysqli_query($conexion, $sql);


header('Location:index.php');

