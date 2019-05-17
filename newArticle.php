<?php
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
$sql = "SELECT nombre FROM Tema";
$stmt = $conn->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
  $tema = $row->nombre;
  $temas[] = $tema;
}
$articuloId = 1;

//Consulta de la imagen
$sql = "SELECT tipoImagen FROM Articulo WHERE idArticulo = 2";
$result = $conn->query($sql);

while ($row2 = $result->fetch(PDO::FETCH_OBJ)) {
  $img = $row2->tipoImagen;
  $images[] = $img;
}
// print_r($images);

?>
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card my-5 bg-light">
          <div class="card-body">
            <h2 class="card-title text-center text-primary">Nuevo articulo</h2>
            <form action="insertArticle.php" method="post" enctype="multipart/form-data">
              <img src="<?php echo $images[0]; ?>" class="img-fluid rounded mx-auto d-block">
              <div class="form-group">
                <label for="inputTitle">Titulo</label>
                <input name="titulo" type="text" class="form-control" required autofocus>
              </div>
              <div class="form-group">
                <label for="inputSubtitle">Subtitulo</label>
                <input name="subtitulo" type=" text" class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="topic">Tema</label>
                <select class="form-control" name="tema">
                <?php for ($x = 0; $x < sizeof($temas); $x++) { ?>
                    <option value=" <?php echo $x + 1; ?>"> <?php echo $temas[$x]; ?> </option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputContent">Contenido</label>
                <textarea name="contenido" class="form-control" id="inputContent" rows="12"></textarea>
              </div>
              <div class="custom-file">
                <input class="custom-file-input" type="file" name="fileToUpload" id="fileToUpload">
                <label class="custom-file-label" for="fileToUpload">Seleccione imagen</label>
              </div>
              <input class="btn btn-primary btn-block mt-4" type="submit" value="Publicar" name="submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#fileToUpload').on('change', function() {
      //get the file name
      let fileName = $(this).val().split('\\').pop();
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
    })
  </script>
</body>

</html>