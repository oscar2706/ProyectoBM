<?php
include("ClassArticulo.php");
include("userClass.php");
include("connection.php");
session_start();
$idArticulo = $_POST['idArticulo'];
// $idUsuario = $_POST['idUsuario']; //Usar la variable de sesion con idUsuario
$reaccion = $_POST['reaccion'];
$idUsuario = $_SESSION['usuario']->getIdUsuario();

$sql = "SELECT idTema FROM Articulo WHERE idArticulo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idArticulo]);
$idTema = $stmt->fetch();

//1=gusta, 2=disgusta y 3=mhe
$sql = "SELECT reaccion FROM MeGustaArticulo WHERE idUsuario = ? AND idArticulo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idUsuario, $idArticulo]);

$gustaRegistrado = false;

if ($stmt->rowCount() > 0) {	//ReaccionRegistrada
	$gustaUsuario = $stmt->fetch();
	$gustaRegistrado = true;

	$sql = "UPDATE MeGustaArticulo SET reaccion = ? WHERE idUsuario = ? AND idArticulo = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$reaccion, $idUsuario, $idArticulo]);

	$sql = "SELECT meGusta FROM MeGustaTema WHERE idUsuario = ? AND idTema = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idTema[0]]);

	if ($stmt->rowCount() == 1) {	//GustaTema Registrado
		$gustaTema = $stmt->fetch();
		switch ($reaccion) {
			case 1:
				$gustaTema[0] += 2;
				break;

			case 2:
				$gustaTema[0] -= 2;
				break;

			case 3:
				$gustaTema[0] -= 1;
				break;
		}
		$sql = "UPDATE MeGustaTema SET meGusta = ? WHERE idUsuario = ? AND idTema = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$gustaTema[0], $idUsuario, $idTema[0]]);

	} else {	//GustaTema Sin registrar
		$gustaTema = 0;
		switch ($reaccion) {
			case 1:
				$gustaTema[0] = 2;
				break;

			case 2:
				$gustaTema[0] = -2;
				break;

			case 3:
				$gustaTema[0] = -1;
				break;
		}
		$sql = "INSERT INTO MeGustaTema (idUsuario, idTema, meGusta) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$idUsuario, $idTema[0], $gustaTema[0]]);
	}
	echo "Guardado";

} else {	//Reaccion Sin registrar
	$sql = "INSERT INTO MeGustaArticulo (idUsuario, idArticulo, reaccion) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idArticulo, $reaccion]);

	$sql = "SELECT reaccion FROM MeGustaArticulo WHERE idUsuario = ? AND idArticulo = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idArticulo]);
	$gustaUsuario = $stmt->fetch();
	$gustaRegistrado = true;

	$sql = "SELECT meGusta FROM MeGustaTema WHERE idUsuario = ? AND idTema = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$idUsuario, $idTema[0]]);

	if ($stmt->rowCount() == 1) {	//GustaTema Registrado
		$gustaTema = $stmt->fetch();
		switch ($reaccion) {
			case 1:
				$gustaTema[0] += 2;
				break;

			case 2:
				$gustaTema[0] -= 2;
				break;

			case 3:
				$gustaTema[0] -= 1;
				break;
		}
		$sql = "UPDATE MeGustaTema SET meGusta = ? WHERE idUsuario = ? AND idTema = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$gustaTema[0], $idUsuario, $idTema[0]]);

	} else {	//GustaTema Sin registrar
		$gustaTema = 0;
		switch ($reaccion) {
			case 1:
				$gustaTema = 2;
				break;

			case 2:
				$gustaTema = -2;
				break;

			case 3:
				$gustaTema = -1;
				break;
		}
		$sql = "INSERT INTO MeGustaTema (idUsuario, idTema, meGusta) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$idUsuario, $idTema[0], $gustaTema]);
	}

	echo "Guardado";
}
