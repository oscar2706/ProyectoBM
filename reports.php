<?php
include("ClassArticulo.php");
include("userClass.php");
include("connection.php");
session_start();
$idUser = $_SESSION['usuario']->getIdUsuario();
$sql = "SELECT idTema, SUM(meGusta) as meGusta FROM MeGustaTema as M INNER JOIN Usuario as U on M.idUsuario = U.idUsuario WHERE U.idGenero = 1 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo "TemaGusta Hombres<br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $idTemaHombre = $row->idTema;
   $meGustaHombre = $row->meGusta;
   echo "id:",$idTemaHombre,", reaccion:",$meGustaHombre,"<br>";
}
echo"<br>";

$sql = "SELECT idTema, SUM(meGusta) as meGusta FROM MeGustaTema as M INNER JOIN Usuario as U on M.idUsuario = U.idUsuario WHERE U.idGenero = 2 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo "TemaGusta Mujeres<br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $idTemaMujer = $row->idTema;
   $meGustaMujer = $row->meGusta;
   echo "id:",$idTemaMujer,", reaccion:",$meGustaMujer,"<br>";
}
echo"<br>";

$sql = "SELECT idTema, SUM(meGusta) as meGusta FROM MeGustaTema as M INNER JOIN Usuario as U on M.idUsuario = U.idUsuario WHERE U.edad >= 18 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo "TemaGusta Edad >=18 <br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $idTemaMujer = $row->idTema;
   $meGustaMujer = $row->meGusta;
   echo "id:",$idTemaMujer,", reaccion:",$meGustaMujer,"<br>";
}
echo"<br>";

$sql = "SELECT idTema, SUM(meGusta) as meGusta FROM MeGustaTema as M INNER JOIN Usuario as U on M.idUsuario = U.idUsuario WHERE U.edad < 18 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo "TemaGusta Edad <18 <br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $idTemaMujer = $row->idTema;
   $meGustaMujer = $row->meGusta;
   echo "id:",$idTemaMujer,", reaccion:",$meGustaMujer,"<br>";
}
echo"<br>";
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
            <li class="nav-item">
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
                     <button class="btn btn-primary" type="submit">Salir</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               </div>
            </div>
         </div>
      </div>

   </nav>

   <div class="container px-5">
      <h1 class="text-center text-primary p-3">Reportes</h1>

      <div class="table-responsive">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col">Tema</th>
                  <th scope="col">Característica</th>
                  <th scope="col">Valoración</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
               </tr>
               <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
               </tr>
               <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
               </tr>
            </tbody>
         </table>
      </div>

   </div>

</body>

</html>