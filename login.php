<?php
session_start();
require_once "BD/conexionBD.php";

if (!empty($_POST["usuario"]) && !empty($_POST["contraseña"])) {
  $nombre = $_POST["usuario"];
  $recuerda = $conexion->prepare('SELECT id_usuario, Nombre_de_usuario, Tipo,  password FROM usuarios WHERE Nombre_de_usuario=:Nombre_de_usuario');
  $recuerda->bindParam(":Nombre_de_usuario", $nombre);
  $recuerda->execute();
  $resultado = $recuerda->fetch(PDO::FETCH_ASSOC);
  $mensaje = "";


  if ($resultado != false) {
    // Acordarse de poner las contraseñas encriptadas a la hora de registrar los usuario, y aqui usar passwordverify
    if ($resultado["Nombre_de_usuario"] == $nombre && password_verify($_POST["contraseña"], $resultado["password"])) {
      $_SESSION['id_usuario'] = $resultado["id_usuario"];
      header("location: Controladores/loginController.php");
    } else {
      $mensaje = "Contraseña incorrecta";
    }
  } else {
    $mensaje = "Lo siento, este usuario no existe";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Iniciar Sesion</title>
</head>

<body>
  <!-- BARRA DE NAVEGACION -->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="encabezado">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold" href="index.php"><img class="media-object rounded-circle" src="img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
      <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="Calendario_Competiciones.php">Calendario de
              Competiciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" id="texcab" href="Album.php">Albumes</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Aqui es donde realizo el formulario incluyendo la imagen del lateral y los botones de facebook y googel -->
  <div class="w-100 d-md-block container w-75 bg-primary rounded shadow mt-sm-4">
    <div class="row align-items-lg-stretch">
      <div class="col-auto d-none d-lg-block bg-white" rounded">
        <img src="img/login.jpeg" width="700" height="750">
      </div>
      <div class="col bg-white p-5 rounded-end">
        <div class="text-start">
          <img src="img/logo.jpg" width="50" alt="logo" class="rounded">
          CDA San Juan de Aznalfarache
        </div>
        <h2 class="text-center p-5 fst-italic">BIENVENIDO AL CLUB</h2>

        <!--Login-->
        <?php
        if (!empty($mensaje)) {
          echo "<h1>$mensaje</h1>";
        }
        ?>

        <form action="login.php" method="post" id="iniciarSesion" class="needs-validation">
          <div class="mb-4">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" required>
          </div>

          <div class="mb-4">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contraseña" id="contraseña" required>

          </div>

          <div class="d-grid mt-5">
            <input type="submit" value="Iniciar Sesion" class="btn btn-dark" "iniciar" name="iniciar">
          </div>
        </form>

      </div>
    </div>
  </div>
  <footer class="footer mt-5 py-3 bg-danger">
    <div class="container-fluid">
      <span class="text-white" id="letra">CDA San Juan De Aznalfarache | <span>Deny Enrique</span> </span>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>