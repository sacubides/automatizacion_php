<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();

if (isset($_POST['enviar'])){
    $name = $_POST['name'];
    $vaccine = $_POST['vaccine'];
    $query = $conexion->prepare("INSERT INTO `vaccines`(`vaccinator`, `vaccine`, `pet-code`) VALUES (:name, :vaccine, 1)");
    $query->bindParam(':name',$name);
    $query->bindParam(':vaccine',$vaccine);
    $query->execute();
    echo '<script>alert("La vacuna se ha creado!")</script>
    <script>window.location="./view-vaccines.php"</script>';
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Crear Mascota</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="./view-vaccines.php">Vacunas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-vaccines.php" aria-current="page">Nueva vacuna<span class="visually-hidden">(current)</span></a>
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
        <div class="container-md">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de vacunador</label>
                    <input type="text"
                        class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Por favor no uses numeros!</small>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Nombre de la vacuna</label>
                    <input type="text"
                        class="form-control" name="vaccine" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Los nombres no tienen numeros!</small>
                </div>
                <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
            </form>
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