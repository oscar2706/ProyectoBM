<?php
include("dataBase.php");

$nombre=$_POST['inputUserName'];
$edad=$_POST['inputAge'];
$genero=$_POST['sex'];
$estadoCivil=$_POST['maritalStatus'];
$contraseña=$_POST['password'];
$verificación=$_POST['password2'];
$base = new dataBase();

$base->addUser($nombre, $contraseña, $edad, $genero, $estadoCivil, $_POST['tema']['0'], $_POST['tema']['1'], $_POST['tema']['2']);

header('Location: recommendedArticles.php');
?>