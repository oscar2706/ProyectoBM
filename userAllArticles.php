<?php
include("ClassArticulo.php");
include("userClass.php");
include("connection.php");
session_start();
$idUser = $_SESSION['usuario']->getIdUsuario();
// echo "idUsuario = ",$idUser , "<br>";

$sql = "SELECT * FROM Articulo";
$result = $conn->query($sql);
while ($row2 = $result->fetch(PDO::FETCH_OBJ)) {
   $id = $row2->idArticulo;
   $titulo = $row2->titulo;
   $subtitulo = $row2->subtitulo;
   $contenido = $row2->contenido;
   $fecha = $row2->fechaCreacion;
   $img = $row2->tipoImagen;
   $idTema = $row2->idTema;
   $idAutor = $row2->idUsuario;
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
?>
<!DOCTYPE html>
<html lang="es_MX">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Proyecto BM</title>
   <!-- Importaciones -->
   <!-- Importaciones -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="icons.css">
</head>

<body class="bg-light">
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="recommendedArticles.php">Proyecto BM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="recommendedArticles.php">Recomendaciones<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
               <a class="nav-link" href="userAllArticles.php">Todos los articulos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="userArticlesByTopic.php">Por tema</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="userArticlesByLikes.php">Más gustados</a>
            </li>
         </ul>
      </div>

      <ul class="nav justify-content-end">
         <li class="nav-item dropdown bg-light rounded">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menú </a>
            <div class="dropdown-menu dropdown-menu-right">
               <p class="dropdown-item disabled">Hola <?php echo $_SESSION['usuario']->getNombre(); ?>! 😁</p>
               <a class="dropdown-item" href="myArticles.php">Mis articulos</a>
               <a class="dropdown-item" href="reports.php">Reportes</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Salir</a>
            </div>
         </li>
      </ul>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirme salida</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-footer">
                  <form action="index.php">
                     <button class="btn btn-primary" type="submit">
                        Salir
                     </button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               </div>
            </div>
         </div>
      </div>

   </nav>

   <div class="container-fluid px-5">
      <h1 class="text-center text-primary p-3">Todos los articulos</h1>
      <div class="row justify-content-center">
         <?php for ($x = 0; $x < sizeof($articulos); $x++) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
               <div class="card shadow p-2 mb-5 bg-white rounded">
                  <img class="card-img-top rounded" src="<?php echo $articulos[$x]->getPathImagen(); ?>">
                  <div class="card-body">
                     <h3 class="card-title"><?php echo $articulos[$x]->getTitulo(); ?></h3>
                     <h5 class="card-title"><?php echo $articulos[$x]->getSubtitulo(); ?></h5>
                     <h5><span class="badge badge-pill badge-info"><?php echo $articulos[$x]->getTema(); ?></span></h5>
                     <hr>
                     <p class="card-text"><?php echo $articulos[$x]->getContenido(); ?></p>
                     <div class="row justify-content-center mb-2">
                        <button type="button" id="like-<?php echo $articulos[$x]->getId(); ?>-<?php echo $idUser; ?>" class="btn <?php if ($articulos[$x]->getGusta() == 1) echo "btn-primary"; ?> mx-2">👍🏻</button>
                        <button type="button" id="dislike-<?php echo $articulos[$x]->getId(); ?>-<?php echo $idUser; ?>" class="btn <?php if ($articulos[$x]->getGusta() == 2) echo "btn-primary"; ?> mx-2">👎🏻</button>
                        <button type="button" id="mhe-<?php echo $articulos[$x]->getId(); ?>-<?php echo $idUser; ?>" class="btn <?php if ($articulos[$x]->getGusta() == 3) echo "btn-primary"; ?> mx-2">😐</button>
                     </div>
                     <p class="card-text">
                        <small class="text-muted"><?php echo $articulos[$x]->getFecha(); ?></small>
                     </p>
                  </div>
               </div>
            </div>
         <?php } ?>
      </div>
   </div>

   <script>
      $("button[id|='like']").click(function() {
         var idBoton = $(this).attr('id').toString();
         console.log('idBoton=', idBoton);
         var idsSplit = idBoton.split("-");
         let idArticulo = idsSplit[1];
         let idUsuario = idsSplit[2];
         console.log("GUSTA idArticulo:" + idArticulo + ", IdUsuario:" + idUsuario);
         $(this).toggleClass("btn-primary");
         let btnDislikeId = "dislike-" + idArticulo + "-" + idUsuario;
         let btnDislike = $("button[id=" + btnDislikeId + "]");
         let btnMheId = "mhe-" + idArticulo + "-" + idUsuario;
         let btnMhe = $("button[id=" + btnMheId + "]");
         if ($(this).hasClass('btn-primary')) {
            btnDislike.removeClass('btn-primary');
            btnMhe.removeClass('btn-primary');
            $.ajax({
               url: 'updateLike.php',
               method: 'POST',
               data: {
                  idArticulo: idArticulo,
                  idUsuario: idUsuario,
                  reaccion: 1
               },
               success: function(response) {
                  if (response != "Guardado")
                     alert(response);
               }
            });
         }
      });
      $("button[id|='dislike']").click(function() {
         var idBoton = $(this).attr('id');
         var idsSplit = idBoton.split("-");
         let idArticulo = idsSplit[1];
         let idUsuario = idsSplit[2];
         console.log("Disgusta idArticulo:" + idArticulo + ", IdUsuario:" + idUsuario);
         $(this).toggleClass("btn-primary");
         let btnLikeId = "like-" + idArticulo + "-" + idUsuario;
         let btnlike = $("button[id=" + btnLikeId + "]");
         let btnMheId = "mhe-" + idArticulo + "-" + idUsuario;
         let btnMhe = $("button[id=" + btnMheId + "]");
         if ($(this).hasClass('btn-primary')) {
            btnlike.removeClass('btn-primary');
            btnMhe.removeClass('btn-primary');
            $.ajax({
               url: 'updateLike.php',
               method: 'POST',
               data: {
                  idArticulo: idArticulo,
                  idUsuario: idUsuario,
                  reaccion: 2
               },
               success: function(response) {
                  if (response != "Guardado")
                     alert(response);
               }
            });
         }
      });
      $("button[id|='mhe']").click(function() {
         var idBoton = $(this).attr('id');
         var idsSplit = idBoton.split("-");
         let idArticulo = idsSplit[1];
         let idUsuario = idsSplit[2];
         console.log("Mhe idArticulo:" + idArticulo + ", IdUsuario:" + idUsuario);
         $(this).toggleClass("btn-primary");
         let btnLikeId = "like-" + idArticulo + "-" + idUsuario;
         let btnLike = $("button[id=" + btnLikeId + "]");
         let btnDislikeId = "dislike-" + idArticulo + "-" + idUsuario;
         let btnDislike = $("button[id=" + btnDislikeId + "]");
         if ($(this).hasClass('btn-primary')) {
            btnLike.removeClass('btn-primary');
            btnDislike.removeClass('btn-primary');
            $.ajax({
               url: 'updateLike.php',
               method: 'POST',
               data: {
                  idArticulo: idArticulo,
                  idUsuario: idUsuario,
                  reaccion: 3
               },
               success: function(response) {
                  if (response != "Guardado")
                     alert(response);
               }
            });
         }
      });
   </script>

</body>

</html>