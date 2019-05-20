<?php
include("ClassArticulo.php");
include("userClass.php");
include("connection.php");
session_start();

$idUser = $_SESSION['usuario']->getIdUsuario();
// echo "idUsuario = ",$idUser , "<br>";

$sql = "SELECT idArticulo, COUNT(reaccion) AS gusta FROM MeGustaArticulo WHERE reaccion = ? GROUP BY idArticulo LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->execute([1]);
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $article = $row->idArticulo;
   $reaccion = $row->gusta;
   // echo "idArticulo:", $article;
   // echo ", meGusta:", $reaccion, "<br>";
   $ids[] = $article;
   $reacciones[] = $reaccion;
}

$idTemasSize = sizeof($ids);

for ($i = 0; $i < $idTemasSize; $i++) {
   $sql = "SELECT * FROM Articulo WHERE idArticulo = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$ids[$i]]);

   while ($articuloQry = $stmt->fetch(PDO::FETCH_OBJ)) {
      $id = $articuloQry->idArticulo;
      $titulo = $articuloQry->titulo;
      $subtitulo = $articuloQry->subtitulo;
      $contenido = $articuloQry->contenido;
      $fecha = $articuloQry->fechaCreacion;
      $img = $articuloQry->tipoImagen;
      $idTema = $articuloQry->idTema;
      $idAutor = $articuloQry->idUsuario;
      $artGusta = -1;
      $gustaSql = "SELECT reaccion FROM MeGustaArticulo WHERE idArticulo = ? and idUsuario = ?";
      $gustaStmt = $conn->prepare($gustaSql);
      if ($gustaStmt->execute([$id, $idUser])) {
         $rowGusta = $gustaStmt->fetch();
         switch ($rowGusta[0]) {
            case 1:
               $artGusta = 1;
               break;
            case 2:
               $artGusta = 2;
               break;
            case 3:
               $artGusta = 3;
               break;
            default:
               break;
         }
      }
      $articulo = new Articulo($id, $titulo, $subtitulo, $contenido, $fecha, $img, $idTema, $idAutor, $idUser, $artGusta);
      $articulos[] = $articulo;
   }
}
?>
<!DOCTYPE html>
<html lang="es_MX">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Proyecto BM</title>
   <!-- Importaciones -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="index.php">Proyecto BM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="index.php">Todos los articulos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
               <a class="nav-link" href="articlesByLikes.php">Más gustados</a>
            </li>
         </ul>
      </div>
      <form class="form-inline" action="login.php">
         <button class="btn btn-light my-2 my-sm-0 text-primary" type="submit">Iniciar sesión</button>
      </form>
   </nav>

   <div class="container-fluid px-5">
      <h1 class="text-center text-primary p-3">Más gustados</h1>

      <div class="row justify-content-center">
         <?php for ($x = 0; $x < sizeof($articulos); $x++) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
               <div class="card shadow p-2 mb-5 bg-white rounded">
                  <img class="card-img-top rounded" src="<?php echo $articulos[$x]->getPathImagen(); ?>">
                  <div class="card-body">
                     <h3 class="d-inline card-title"><?php echo $articulos[$x]->getTitulo(); ?></h3>
                     <p class="d-inline bg-primary ml-2 py-2 px-3 text-white rounded">👍🏻 x<?php echo $reacciones[$x]; ?> </p>
                     <h5 class="card-title mt-2"><?php echo $articulos[$x]->getSubtitulo(); ?></h5>
                     <h5><span class="badge badge-pill badge-info"><?php echo $articulos[$x]->getTema(); ?></span></h5>
                     <hr>
                     <p class="card-text"><?php echo $articulos[$x]->getContenido(); ?></p>
                     <p class="card-text mt-2">
                        <small class="text-muted"><?php echo $articulos[$x]->getFecha(); ?></small>
                     </p>
                  </div>
               </div>
            </div>
         <?php } ?>
      </div>

   </div>
</body>

</html>