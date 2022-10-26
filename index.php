
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Proyectos</title>
</head>

<body>
    <div class="container">
        <br>
        <h3>Lista de proyectos</h3>
        <br>
        <div class="contiener">
            <a href="./Nuevo.php" class="btn btn-dark"> Agregar Proyecto</a>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    ini_set('display_errors',1);
                    error_reporting(E_ALL);
                    include "Config/Conexion.php";
                    $sql = "SELECT * FROM tm_proyecto";
                    $mysqli = $conexion->query($sql);
                    while ($row = $mysqli->fetch_assoc()) { 
                        $sqlNew = "SELECT * FROM tm_imagen WHERE proy_id = {$row['proy_id']}";
                        $images = $conexion->query($sqlNew)->fetch_assoc();
                        ?>
                        <tr>
                            <td> <?php echo $row['proy_id'] ?> </td>
                            <td><?php echo $row['proy_nom'] ?></td>
                            <td><?php echo $row['proy_desc'] ?></td>
                            <td><?php echo $row['proy_date'] ?></td>
                            <td>
                                <img style="width: 200px;" src="<?php echo "http://localhost/Proyectos/".$images['ima_path'] ?>" alt=""> 
                            </td>
                            <td>
                                <a href="./Editar.php?id=<?php echo $row['proy_id']?>" class="btn btn-warning">Editar</a>
                                <a href="./EliminarProyecto.php?id=<?php echo $row['proy_id']?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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