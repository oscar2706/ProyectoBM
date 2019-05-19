<?php
include("ClassArticulo.php");

$db_servername = "localhost";
$db_usuario = "root";
$db_contrasena = "";
$dbname = "proyectoBM";

$idArticulo = $_POST['idArticulo'];
$idUsuario = $_POST['idUsuario'];
$gusta = $_POST['gusta'];

try {
	$conn = new PDO("mysql:host=$db_servername;dbname=$dbname", $db_usuario, $db_contrasena);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("SET NAMES 'utf8';");
} catch (PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

$sql = "SELECT idTema FROM Articulo WHERE idArticulo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idArticulo]);
$idTema = $stmt->fetch();

