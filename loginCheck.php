<?php
include("dataBase.php");

$nombre=$_POST['inputUserName'];
$contraseña=$_POST['inputPassword'];
$base = new dataBase();

$loginExitoso = $base->loginUser($nombre, $contraseña);

if($loginExitoso==1) {
    header('Location: recommendedArticles.php');
}
else {
    header('Location: login.php');
}
?>