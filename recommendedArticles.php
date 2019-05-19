<!DOCTYPE html>
<html lang="es_MX">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Proyecto BM</title>
      <!-- Importaciones -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
              integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
              crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
              integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
              crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
              integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
              crossorigin="anonymous"></script>
   </head>

   <body>
      <?php
         include ("userClass.php");
         session_start();

         $usuario = $_SESSION['usuario'];
      ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
         <a class="navbar-brand" href="">Proyecto BM <?php echo $usuario->getNombre(); ?></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                 aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="recommendedArticles.html">Recomendaciones<span
                           class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="userAllArticles.html">Todos los articulos<span
                           class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="userArticlesByTopic.html">Por tema</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="userArticlesByLikes.html">Más gustados</a>
               </li>
            </ul>
         </div>

         <ul class=" nav justify-content-end">
            <li class="nav-item dropdown bg-light">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="true" aria-expanded="false">Menú </a>
               <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="myArticles.html">Mis articulos</a>
                  <a class="dropdown-item" href="reports.html">Reportes</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Salir</a>
               </div>
            </li>
         </ul>
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
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

      <div class="container">
         <h1 class="text-center text-primary p-3">Recomendados</h1>

         <div class="card-columns">
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
            <div class="card">
               <img class="card-img-top" src="https://picsum.photos/500/500?random&t=${Math.random()}"
                    alt="Card image cap">
               <div class="card-body">
                  <div class="d-flex flex-row">
                     <h3 class="card-title">Título</h3>
                     <div class="ml-3">
                        <button type="button" name="" id="" class="btn btn-primary">👍🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">👎🏻</button>
                        <button type="button" name="" id="" class="btn btn-primary">😐</button>
                     </div>
                  </div>

                  <h5 class="card-title">Subtitulo</h5>
                  <h6 class="card-title">Tema</h6>
                  <p class="card-text">
                     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex in voluptate ullam debitis quisquam
                     natus
                     suscipit, ipsam quasi impedit aliquam ipsum fugit, libero magnam alias nisi officiis dignissimos
                     tempore earum.
                     Quam, animi rem autem similique vitae, nihil ut corporis porro dolor minima aliquam iusto rerum
                     voluptates veritatis quaerat numquam possimus ad earum architecto sed excepturi, ipsum
                     blanditiis
                     ratione. Excepturi, quam.
                  </p>
                  <p class="card-text"><small class="text-muted">01/Junio/2019</small></p>
               </div>
            </div>
         </div>

      </div>
   </body>

</html>