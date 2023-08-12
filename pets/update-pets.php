<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();
$pet = $_GET['id'];
$query = $conexion->prepare("SELECT * FROM `pets` WHERE `id-pet` = :pet");
$query->bindParam(':pet', $pet);
$query->execute();
$result = $query->fetch();
$vaccinequery = $conexion->prepare("SELECT * FROM `vaccines` WHERE `id` != 1 ORDER BY `id` ASC");
$vaccinequery -> execute();
if (isset($_POST['actualizar'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $update = $conexion->prepare("UPDATE `pets` SET `name` = :name, `breed`=:breed, `age`=:age");
}
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
                    <a class="nav-link" href="./view-pets.php">Mascotas <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-pets.php">Nueva mascota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./delete-pets.php">Borrar mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vaccinators/view-vaccines.php">Vacunas</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container-md">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de Mascota</label>
                    <input type="text"
                        class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="<?php echo $result['pet-name'];?>">
                    <small id="helpId" class="form-text text-muted">Por favor no uses numeros!</small>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Edad de la mascota</label>
                    <input type="text"
                        class="form-control" name="age" id="" aria-describedby="helpId" placeholder="" value="<?php echo $result['age'];?>">
                    <small id="helpId" class="form-text text-muted">Los numeros no tienen letras!</small>
                </div>
                <div class="mb-3">
                    <label for="breed" class="form-label">Raza de la mascota</label>
                    <input type="text"
                        class="form-control" name="breed" id="" aria-describedby="helpId" placeholder="" value="<?php echo $result['breed'];?>">
                    <small id="helpId" class="form-text text-muted">Esto nos ayuda a determinar que es mejor para el/ella!</small>
                </div>
                
                <div class="form-check">
                <?php while ($vaccines = $vaccinequery->fetch()){ ?>
                  <input class="form-check-input" type="checkbox" value="<?= $vaccines['id']?>" id="" name="vaccine">
                  <label class="form-check-label" for="vaccine">
                    <?php echo 'Vacuna de '.$vaccines['vaccine'].', por '.$vaccines['vaccinator'].''?>
                  </label>
                <?php }?>

                </div>
                <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
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