<!DOCTYPE html>
<html lang="es_MX">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <!-- Importaciones -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
   <div class="container">
      <div class="row">
         <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card my-5">
               <?php
               session_start();


               if (isset($_SESSION['bandera'])) {
                  $error = $_SESSION['bandera'];
               } else {
                  $error = 0;
               }

               if ($error == 1) {
                  echo "<div class=\"text-center text-danger h3\">Usuario o Contraseña Incorrecta</div>";
               }

               ?>
               <div class="card-body">
                  <h5 class="card-title text-center">Inicio de sesión</h5>
                  <form action="loginCheck.php" method="post">
                     <label for="inputUserName">Nombre de usuario</label>
                     <input type="text" id="inputUserName" name="inputUserName" class="form-control" required autofocus>
                     <label for="inputPassword">Contraseña</label>
                     <input type="password" id="inputPassword" name="inputPassword" class="form-control" required>
                     <button class="btn btn-primary btn-block text-uppercase mt-4" type="submit">Iniciar
                        sesión</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
               <div class="card-body">
                  <p class="card-title text-center">¿Nuevo en Proyecto BM?</p>
                  <form action="signUp.php">
                     <button class="btn btn-secondary btn-block" type="submit">Registrarse</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>