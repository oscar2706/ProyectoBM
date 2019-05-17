<?php
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$contenido = $_POST['contenido'];
$idTema = $_POST['tema'];
$idUsuario = 1;

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
   } else {
      echo "File is not an image.";
      $uploadOk = 0;
   }
}
// Check if file already exists
if (file_exists($target_file)) {
   echo "Sorry, file already exists.";
   $uploadOk = 0;
}

// Allow certain file formats
if (
   $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif"
) {
   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
}

if ($uploadOk == 0) {
   echo "Sorry, your file was not uploaded.";
   // if everything is ok, try to upload file
} else {
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
   } else {
      echo "Sorry, there was an error uploading your file.";
   }
}

$db_servername = "localhost";
$db_usuario = "root";
$db_contrasena = "";
$dbname = "proyectoBM";
try {
   $conn = new PDO("mysql:host=$db_servername;dbname=$dbname", $db_usuario, $db_contrasena);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $conn->exec("SET NAMES 'utf8';");
} catch (PDOException $e) {
   echo $sql . "<br>" . $e->getMessage();
}

$tmpName  = $_FILES['fileToUpload']['tmp_name'];
$fp = fopen($tmpName, 'rb');
$hoy = date("Y-m-d");
$stmt = $conn->prepare("INSERT INTO Articulo ( titulo, subtitulo, contenido, fechaCreacion, imagen, tipoImagen, idTema, idUsuario ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ? )");

if ($stmt->execute([$titulo, $subtitulo, $contenido, date("Y-m-d"), $fp, $target_file, $idTema, 1]))
   echo 'Se registro el articulo con la imagen <br>';
else
   echo 'No se registro el articulo!';
echo '<br>';
echo '<br>';
echo $titulo . "<br>";
echo $subtitulo . "<br>";
echo $contenido . "<br>";
echo $idTema . "<br>";
echo $target_file . "target <br>";
echo $tmpName . ": tmpName <br>";
echo $fp . "fp <br>";
// echo $tmpName . "tmpname <br>";
