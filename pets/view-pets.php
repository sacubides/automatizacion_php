<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();

$query = $conexion->prepare("SELECT * FROM `pets`, `vaccines` WHERE `fk-vaccine` = vaccines.id AND `id-pet` != 1");
$query->execute();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Mascotas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="./view-pets.php" aria-current="page">Mascotas <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-pets.php">Nueva mascota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vaccinators/view-vaccines.php">Vacunas</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container table-responsive-md">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Fecha de ultima vacuna</th>
                        <th scope="col">Nombre de vacuna</th>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($result = $query->fetch()){  
                    $nextdate = $result['nextdate'];
                    $currdate = date('Y-m-d H:i:s');
                    if ($nextdate <= $currdate){
                        $msj = 'La mascota requiere la siguiente vacuna de'.$result['vaccine'];
                        $class = 'class="table-warning"';
                    } else { $msj = 'La mascota esta al dia con sus vacunas.'; $class = 'class="table-success"';}
                ?>

                    <tr class="">
                        <td scope="row"><?= $result['pet-name']?></td>
                        <td scope="row"><?= $result['id-pet']?></td>
                        <td scope="row"><?= $result['age']?></td>
                        <td scope="row"><?= $result['breed']?></td>
                        <td scope="row"><?= $result['date']?></td>
                        <td scope="row"><?= $result['vaccine']?></td>
                        <td scope="row" <?= $class?>><?= $msj?></td>
                        <td scope="row"><a class="btn btn-primary" href="update-pets.php?id=<?= $result['id-pet']?>" role="button">Actualizar</a></td>
                        <td scope="row"><a class="btn btn-danger" href="delete-pets.php?id=<?= $result['id-pet']?>" onclick="return(alert('Quiere borrar a <?= $result['pet-name']?>?'))" role="button">Borrar</a></td>
                    </tr>

                <?php }?>
                </tbody>
            </table>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>