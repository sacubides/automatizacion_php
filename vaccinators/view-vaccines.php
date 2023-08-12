<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();

$query = $conexion->prepare("SELECT * FROM vaccines WHERE id != 1");
$query->execute();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Vacunas</title>
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
                    <a class="nav-link active" href="./view-vaccines.php" aria-current="page">Vacunas <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-vaccines.php">Nueva vacuna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./vaccinate.php">Vacunar mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pets/view-pets.php">Mascotas</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container table-responsive-md">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Vacuna</th>
                        <th scope="col">Personal</th>
                    </tr>
                </thead>
                <tbody>

                <?php while($result = $query->fetch()){?>
                    <tr class="">
                        <td scope="row"><?= $result['vaccine']?></td>
                        <td scope="row"><?= $result['vaccinator']?></td>
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