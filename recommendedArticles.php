<?php
include("ClassArticulo.php");
$db_servername = "localhost";
$db_usuario = "root";
$db_contrasena = "";
$dbname = "proyectoBM";
$idUser = 1;

try {
  $conn = new PDO("mysql:host=$db_servername;dbname=$dbname", $db_usuario, $db_contrasena);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->exec("SET NAMES 'utf8';");
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$sql = "SELECT nombre FROM Tema";
$stmt = $conn->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
  $tema = $row->nombre;
  $temas[] = $tema;
}

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
  // echo $artGusta;
  $articulo = new Articulo($id, $titulo, $subtitulo, $contenido, $fecha, $img, $idTema, $idAutor, $idUser, $artGusta);
  $articulos[] = $articulo;
}

?>

<!DOCTYPE html>
<html lang="es_MX">

<head>
  <meta charset="UTF-8">
  <meta idArticulo="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Proyecto BM</title>
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
    <a class="navbar-brand" href="">Proyecto BM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="recommendedArticles.html">Recomendaciones<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="userAllArticles.html">Todos los articulos<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="userArticlesByTopic.html">Por tema</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="userArticlesByLikes.html">Más gustados</a>
        </li>
      </ul>

      <ul class="nav justify-content-end">
        <li class="nav-item dropdown bg-light">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menú
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="myArticles.html">Mis articulos</a>
            <a class="dropdown-item" href="reports.html">Reportes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Salir</a>
          </div>
        </li>
      </ul>
    </div>

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
            <form action="index.html">
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
    <h1 class="text-center text-primary p-3">Recomendados</h1>

    <div class="row">
      <?php for ($x = 0; $x < sizeof($articulos); $x++) { ?>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="shadow p-2 mb-5 bg-white rounded">
            <img class="card-img-top rounded" src="<?php echo $articulos[$x]->getPathImagen(); ?>">
            <div class="card-body">
              <h3 class="card-title"><?php echo $articulos[$x]->getTitulo(); ?></h3>
              <h5 class="card-title"><?php echo $articulos[$x]->getSubtitulo(); ?></h5>
              <h5><span class="badge badge-pill badge-info"><?php echo $articulos[$x]->getTema(); ?></span></h5>
              <!-- <h6 class="card-title"><?php echo $articulos[$x]->getTema(); ?></h6> -->
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
      var idBoton = $(this).attr('id');
      idArticulo = idBoton.charAt(5);
      idUsuario = idBoton.charAt(7);
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
            if (response == "Guardado")
              alert("Se guardo");
            else
              alert(response);
            // TODO: Actualizar gustos
          }
        });
      }
    });

    $("button[id|='dislike']").click(function() {
      var idBoton = $(this).attr('id');
      idArticulo = idBoton.charAt(8);
      idUsuario = idBoton.charAt(10);
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
            if (response == "Guardado")
              alert("Se guardo");
            else
              alert(response);
            // TODO: Actualizar gustos
          }
        });
      }
    });

    $("button[id|='mhe']").click(function() {
      var idBoton = $(this).attr('id');
      idArticulo = idBoton.charAt(4);
      idUsuario = idBoton.charAt(6);
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
            if (response == "Guardado")
              alert(response);
            else
              $(this).toggleClass("btn-primary");
            // TODO: Actualizar gustos
          }
        });
      }
    });
  </script>
</body>

</html>