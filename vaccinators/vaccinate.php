<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();
$query = $conexion->prepare("SELECT * FROM `pets` WHERE `id-pet` != 1");
$query->execute();
$fecha_fin = date('Y-m-d', strtotime('+3 months'));
$vaccinequery = $conexion->prepare("SELECT * FROM `vaccines` WHERE `id` != 1 ORDER BY `id` ASC");
$vaccinequery -> execute();
if (isset($_POST['vacunar'])){
    $pet = $_POST['pet'];
    $vaccine = $_POST['vaccine'];
    $nextdate = date('Y-m-d', strtotime('+3 months'));
    $update = $conexion->prepare("UPDATE `pets` SET `date` = NOW(), `nextdate` = :nextdate, `fk-vaccine` = :vaccine WHERE `id-pet` = :pet");
    $update->bindParam(':vaccine',$vaccine);
    $update->bindParam(':nextdate',$nextdate);
    $update->bindParam(':pet',$pet);
    $update->execute();
    echo '<script>alert("La mascota se ha vacunado!")</script>
    <script>window.location="./view-vaccines.php"</script>';
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
        <div class="container-md">
            <form method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Mascota</label>
                    <select class="form-select form-select-lg" name="pet" id="" required>
                        <option selected disabled>Elije una</option>
                        <?php while($result = $query->fetch()){?>
                        <option value="<?=$result['id-pet'] ?>"><?=$result['pet-name'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <label for="">Vacunas actuales</label>
                <?php while ($vaccines = $vaccinequery->fetch()){ ?>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="<?= $vaccines['id']?>" id="" name="vaccine">
                  <label class="form-check-label" for="vaccine">
                    <?php echo 'Vacuna de '.$vaccines['vaccine'].', por '.$vaccines['vaccinator'].''?>
                  </label>
                </div>
                <?php }?>

                <button type="submit" name="vacunar" class="btn btn-primary">Vacunar</button>
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