<?php
// $db_usuario = "Leonardo";
// $db_contrasena = "football26398";
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
