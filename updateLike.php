<?php
include("ClassArticulo.php");

$db_servername = "localhost";
$db_usuario = "root";
$db_contrasena = "";
$dbname = "proyectoBM";

$idArticulo = $_POST['idArticulo'];
$idUsuario = $_POST['idUsuario']; //Usar la variable de sesion con idUsuario
$reaccion = $_POST['reaccion'];

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

//1=gusta, 2=disgusta y 3=mhe
$sql = "SELECT reaccion FROM MeGustaArticulo WHERE idUsuario = ? AND idArticulo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idUsuario, $idArticulo]);

$gustaRegistrado = false;
if ($stmt->rowCount() == 1) {
	$gustaUsuario = $stmt->fetch();
	$gustaRegistrado = true;

	$sql = "UPDATE MeGustaArticulo SET reaccion = ? WHERE idUsuario = ? AND idArticulo = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$reaccion, $idUsuario, $idArticulo]);
	echo "Guardado";

} else {
	$sql = "INSERT INTO MeGustaArticulo (idUsuario, idArticulo, reaccion) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idArticulo, $reaccion]);

	$sql = "SELECT reaccion FROM MeGustaArticulo WHERE idUsuario = ? AND idArticulo = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idArticulo]);
	$gustaUsuario = $stmt->fetch();
	$gustaRegistrado = true;
	echo "Guardado";
}

// if ($gustaRegistrado)
	
