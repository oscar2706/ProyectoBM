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
// echo "idTema= ",$idTema[0];

//1=gusta, 2=disgusta y 3=mhe
$sql = "SELECT reaccion FROM MeGustaArticulo WHERE idUsuario = ? AND idArticulo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idUsuario, $idArticulo]);

$gustaRegistrado = false;

if ($stmt->rowCount() == 1) {	//ReaccionRegistrada
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
		echo "gustaTema = ", $gustaTema[0];
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
