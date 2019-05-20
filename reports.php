<?php
include("ClassArticulo.php");
include("userClass.php");
include("connection.php");
session_start();
$idUser = $_SESSION['usuario']->getIdUsuario();
$sql = "SELECT T.nombre, SUM(M.meGusta) as meGusta FROM Tema as T INNER JOIN MeGustaTema AS M ON T.idTema = M.idTema INNER JOIN Usuario AS U ON M.idUsuario = U.idUsuario WHERE U.idGenero = 1 and M.meGusta >0 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
// echo "TemaGusta Hombres<br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $temaHombre = $row->nombre;
   $meGustaHombre = $row->meGusta;
   $temasHombre[] = $temaHombre;
   $meGustasHombre[] = $meGustaHombre;
   // echo "categoria:", $temaHombre, ", reaccion:", $meGustaHombre, "<br>";
}
// echo "<br>";

$sql = "SELECT T.nombre, SUM(M.meGusta) as meGusta FROM Tema as T INNER JOIN MeGustaTema AS M ON T.idTema = M.idTema INNER JOIN Usuario AS U ON M.idUsuario = U.idUsuario WHERE U.idGenero = 2 and M.meGusta >0 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
// echo "TemaGusta Mujeres<br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $temaMujer = $row->nombre;
   $meGustaMujer = $row->meGusta;
   $temasMujer[] = $temaMujer;
   $meGustasMujer[] = $meGustaMujer;
   // echo "id:", $temaMujer, ", reaccion:", $meGustaMujer, "<br>";
}
// echo "<br>";

$sql = "SELECT T.nombre, SUM(M.meGusta) as meGusta FROM Tema as T INNER JOIN MeGustaTema AS M ON T.idTema = M.idTema INNER JOIN Usuario AS U ON M.idUsuario = U.idUsuario WHERE U.edad >= 18 and M.meGusta >0 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
// echo "TemaGusta Edad >=18 <br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $temaMayor = $row->nombre;
   $meGustaMayor = $row->meGusta;
   $temasMayor[] = $temaMayor;
   $meGustasMayor[] = $meGustaMayor;
   // echo "id:", $temaMayor, ", reaccion:", $meGustaMayor, "<br>";
}
// echo "<br>";

$sql = "SELECT T.nombre, SUM(M.meGusta) as meGusta FROM Tema as T INNER JOIN MeGustaTema AS M ON T.idTema = M.idTema INNER JOIN Usuario AS U ON M.idUsuario = U.idUsuario WHERE U.edad < 18 and M.meGusta >0 GROUP BY M.idTema ORDER BY meGusta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
// echo "TemaGusta Edad <18 <br>";
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
   $temaMenor = $row->nombre;
   $meGustaMenor = $row->meGusta;
   $temasMenor[] = $temaMenor;
   $meGustasMenor[] = $meGustaMenor;
   // echo "id:", $temaMenor, ", reaccion:", $meGustaMenor, "<br>";
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
               <?php for ($x = 0; $x < sizeof($temasHombre); $x++) { ?>
                  <tr>
                     <th scope="row"><?php echo $temasHombre[$x]; ?></th>
                     <td>Hombre</td>
                     <td><?php echo $meGustasHombre[$x]; ?></td>
                  </tr>
               <?php } ?>
               <?php for ($x = 0; $x < sizeof($temasMujer); $x++) { ?>
                  <tr>
                     <th scope="row"><?php echo $temasMujer[$x]; ?></th>
                     <td>Mujer</td>
                     <td><?php echo $meGustasMujer[$x]; ?></td>
                  </tr>
               <?php } ?>
               <?php for ($x = 0; $x < sizeof($temasMayor); $x++) { ?>
                  <tr>
                     <th scope="row"><?php echo $temasMayor[$x]; ?></th>
                     <td>>= 18</td>
                     <td><?php echo $meGustasMayor[$x]; ?></td>
                  </tr>
               <?php } ?>
               <?php for ($x = 0; $x < sizeof($temasMenor); $x++) { ?>
                  <tr>
                     <th scope="row"><?php echo $temasMenor[$x]; ?></th>
                     <td>< 18</td>
                     <td><?php echo $meGustasMenor[$x]; ?></td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>

   </div>

</body>

</html>