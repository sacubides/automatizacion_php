<?php
require_once("../db/connection.php");
$basedatos = new Database();
$conexion = $basedatos->conectar();
$pet = $_GET['id'];
$query = $conexion->prepare("DELETE FROM `pets` WHERE `id-pet` = :pet");
$query->bindParam(':pet', $pet);
$query->execute();
echo '<script>alert ("Se ha borrado la mascota.");</script>
<script>window.location="view-pets.php"</script>';
?>