<?php
session_start();
require_once "BD/conexionBD.php";
// require_once "../../Filtros/FiltroAdmin.php";
require "Controladores/NombreUsuario.php";
require "Controladores/CrearUsuarios.php";
require "Controladores/Contenido.php";
$msg = registrarUsuario($conexion);
$usuario = recuerdaUsuario($conexion);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="styles.css">
  <title>Albumes</title>
</head>

<body>
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
        <?php
        if (!empty($usuario)) {
          echo '<div class="btn-group">
            <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                ' . $usuario["Nombre_de_usuario"] . ' (' . $usuario["Tipo"] . ')
            </button>
            <ul class="dropdown-menu bg-dark w-100">
                <li><a class="dropdown-item text-white" id="prueba" href="index.php">Volver a inicio</a></li>
                <li><hr class="dropdown-divider text-white"></li>
                <li><a class="dropdown-item text-white" id="prueba2" href="CerrarSession.php">Cerrar Sesion</a></li>
            </ul>
          </div>';
        } else {
          echo "Invitado";
        }
        ?>


      </div>
    </div>
  </nav>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cantidadImagenes"]) && isset($_POST["urlImagenes"])) {
    $cantidad = $_POST["cantidadImagenes"];
    $url = $_POST["urlImagenes"];

    // Crear cookies con los valores del formulario
    setcookie('cantidad_imagenes', $cantidad, time() + (86400 * 30), "/"); // 30 días de duración
    setcookie('url_imagenes', $url, time() + (86400 * 30), "/"); // 30 días de duración
  }
  ?>

  <?php
  if (isset($usuario) && ($usuario["Tipo"] == "Entrenador" || $usuario["Tipo"] == "Administrador")) {
  ?>
    <!-- Botón para abrir la ventana modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Generar Álbum
    </button>

    <!-- Ventana modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generador de Álbum</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Formulario para ingresar la cantidad de tarjetas de imagen y la URL -->
            <form action="" method="post">
              <div class="mb-3">
                <label for="cantidadImagenes" class="form-label">Cantidad de Imágenes:</label>
                <input type="number" class="form-control" id="cantidadImagenes" name="cantidadImagenes" min="1" required>
              </div>
              <div class="mb-3">
                <label for="urlImagenes" class="form-label">URL de Destino:</label>
                <input type="url" class="form-control" id="urlImagenes" name="urlImagenes" required>
              </div>
              <button type="submit" class="btn btn-primary">Generar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>


  <h1 class="text-center p-3 mt-1 fst-italic  text-decoration-underline " id="txts">ALBUMES DE NUESTROS MEJORES MOMENTOS</h1>
  <main>
    <section class="p-1 text-center container ">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/f957b939-6a73-47f7-a5f7-da3bbafec87c.jpg" class="d-block w-100" alt="">
          </div>
          <div class="carousel-item">
            <img src="img/IMG_0684.JPG" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/IMG_0685.JPG" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cantidadImagenes']) && isset($_POST['urlImagenes'])) {
      // Si se envió el formulario, llamar a la función para generar el álbum con la cantidad ingresada y la URL
      $cantidad = $_POST['cantidadImagenes'];
      $url = $_POST['urlImagenes'];
      generarAlbum($cantidad, $url);
    } else {
      generarAlbum(5, "https://ejemplo.com");
    }
    ?>
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-danger">
    <div class="container-fluid">
      <span class="text-white" id="letra">CDA San Juan De Aznalfarache | <span>Deny Enrique</span> </span>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>