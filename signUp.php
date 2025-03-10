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

<script>
   $(document).ready(function() {

      var limiteEleccion = 3;

      $('input.temas').on('change', function(evt) {
         if ($("input[name='tema[]']:checked").length > limiteEleccion) {
            this.checked = false;
         }
      });
   });
</script>

<body class="bg-light">
   <div class="container">
      <div class="row">
         <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card my-5">
               <div class="card-body">
                  <h5 class="card-title text-center">Registro</h5>
                  <form action="insertUser.php" method="post" class="form-group">
                     <label for="inputUserName">Nombre de usuario</label>
                     <input type="text" id="inputUserName" class="form-control" required autofocus name="inputUserName">

                     <label for="inputAge">Edad</label>
                     <input class="form-control" type="number" value="18" id="inputAge" min="0" name="inputAge">

                     <fieldset class="form-group my-2">
                        <div class="row">
                           <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radioMen" class="custom-control-input" name="sex" requiredAge checked value="1">
                              <label class="custom-control-label" for="radioMen">Hombre</label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radioWomen" class="custom-control-input" name="sex" required value="2">
                              <label class="custom-control-label" for="radioWomen">Mujer</label>
                           </div>
                        </div>
                     </fieldset>

                     <fieldset class="form-group my-2">
                        <div class="row">
                           <legend class="col-form-label col-sm-4 pt-0">Estado civil</legend>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radioSingle" class="custom-control-input" name="maritalStatus" required checked value="1">
                              <label class="custom-control-label" for="radioSingle">Solter@</label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radioMarried" class="custom-control-input" name="maritalStatus" required value="2">
                              <label class="custom-control-label" for="radioMarried">Casad@</label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radioWidow" class="custom-control-input" name="maritalStatus" required value="3">
                              <label class="custom-control-label" for="radioWidow">Viud@</label>
                           </div>
                        </div>
                     </fieldset>

                     <label for="selectedTopics">Temas que te interesan</label>
                     <small class="form-text text-muted">Máximo 3 temas</small>
                     <?php
                     include("dataBase.php");

                     $base = new DataBase();
                     $temas = array();
                     $temasId = array();

                     $temas = $base->getTemas();
                     $temasId = $base->getTemasId();

                     for ($i = 0; $i < sizeof($temas); $i++) {
                        ?>
                        <div class="input-group mb-1">
                           <div class="input-group-prepend">
                              <div class="input-group-text">
                                 <input type="checkbox" aria-label="Checkbox for following text input" class="temas" name="tema[]" value="<?php echo $temasId[$i]; ?>">
                              </div>
                           </div>
                           <p class="form-control" aria-label="Text input with checkbox"><?php echo $temas[$i]; ?></p>
                        </div>

                     <?php
                  }
                  ?>

                     <label for="inputPassword">Contraseña</label>
                     <input type="password" id="inputPassword" class="form-control" required name="password">
                     <label for="inputPassword2">Confirma contraseña</label>
                     <input type="password" id="inputPassword2" class="form-control" required name="password2">
                     <button class="btn btn-primary btn-block text-uppercase mt-4" type="submit">Registrarme</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

</body>

</html>