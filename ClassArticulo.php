<?php
class Articulo
{
	private $id;
	private $idAutor;
	private $titulo;
	private $subtitulo;
	private $contenido;
	private $fecha;
	private $pathImagen;
	private $idTema;
	private $tema;
	private $idUsuario;
	private $gusta; //reaccion 1=gusta, 2=Disgusta y 4=meh

	public function __construct($_id, $_titulo, $_subtitulo, $_contenido, $_fecha, $_pathImagen, $_idTema, $_idAutor)
	{
		$this->id = $_id;
		$this->titulo = $_titulo;
		$this->subtitulo = $_subtitulo;
		$this->contenido = $_contenido;
		$this->fecha = $_fecha;
		$this->pathImagen = $_pathImagen;
		$this->idTema = $_idTema;
		$this->idAutor = $_idAutor;
		$db_servername = "localhost";
		$db_usuario = "root";
		$db_contrasena = "";
		$dbname = "proyectoBM";
		try {
			$conn = new PDO("mysql:host=$db_servername;dbname=$dbname", $db_usuario, $db_contrasena);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("SET NAMES 'utf8';");
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		//se seleccionan todos los artículos
		$sql = "SELECT idTema, nombre FROM Tema";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$idRecibido = $row->idTema;
			$temaRecibido = $row->nombre;
			if ($idRecibido == $this->idTema)
				$this->tema = $temaRecibido;
		}
	}

	public function __construct1($_id, $_titulo, $_subtitulo, $_contenido, $_fecha, $_pathImagen, $_idTema, $_idUsuario, $_gusta, $_idAutor)
	{
		$this->id = $_id;
		$this->titulo = $_titulo;
		$this->subtitulo = $_subtitulo;
		$this->contenido = $_contenido;
		$this->fecha = $_fecha;
		$this->pathImagen = $_pathImagen;
		$this->idTema = $_idTema;
		$this->idUsuario = $_idUsuario;
		$this->gusta = $_gusta;
		$this->idAutor = $_idAutor;

		$db_servername = "localhost";
		$db_usuario = "root";
		$db_contrasena = "";
		$dbname = "proyectoBM";
		try {
			$conn = new PDO("mysql:host=$db_servername;dbname=$dbname", $db_usuario, $db_contrasena);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("SET NAMES 'utf8';");
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		//se seleccionan todos los artículos
		$sql = "SELECT idTema, nombre FROM Tema";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$idRecibido = $row->idTema;
			$temaRecibido = $row->nombre;
			if ($idRecibido == $this->idTema)
				$this->tema = $temaRecibido;
		}
	}

	public function getId()
	{
		return $this->id;
	}
	public function getTitulo()
	{
		return $this->titulo;
	}
	public function getSubtitulo()
	{
		return $this->subtitulo;
	}
	public function getContenido()
	{
		return $this->contenido;
	}
	public function getFecha()
	{
		return $this->fecha;
	}
	public function getPathImagen()
	{
		return $this->pathImagen;
	}
	public function getIdTema()
	{
		return $this->idTema;
	}
	public function getTema()
	{
		return $this->tema;
	}
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	public function getGusta()
	{
		return $this->gusta;
	}
}
