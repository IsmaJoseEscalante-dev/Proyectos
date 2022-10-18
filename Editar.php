<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    include "Config/Conexion.php";
    $id = $_REQUEST['id'];  
    $sql = "SELECT * FROM tm_proyecto WHERE proy_id = $id";
    $mysqli = $conexion->query($sql);   
    $row = $mysqli->fetch_assoc();
    $sqlNew = "SELECT * FROM tm_imagen WHERE proy_id = {$id }";
    $images = $conexion->query($sqlNew)->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Editar proyecto</title>
</head>

<body>
    <div class="container">
        <br>
        <h1>Editar proyecto</h1>
        <br>
        <form action="editarProyecto.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="proy_nom" value="<?php echo $row['proy_nom'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="proy_desc" value="<?php echo $row['proy_desc'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleCheck1" class="form-label">Agregar nuevas imagenes</label>
                <input class="form-control" type="file" id="formFileMultiple" name="image[]" multiple>
            </div>
            <div class="container mb-2">
                <div class="row">
                <?php foreach($images as $image): ?>
                    <div class="card col-4 mb-2 me-4" style="width: 18rem;">
                        <img src="<?php echo "http://localhost/Proyectos/".$image[1] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-end"> 
                                <a href="./EliminarImagen.php?id=<?php echo $image[0]?>" class="btn btn-primary">X</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <input type="hidden" name="proy_id" value="<?= $id ?>">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="./index.php" class="btn btn-info">Volver</a>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>

</html>