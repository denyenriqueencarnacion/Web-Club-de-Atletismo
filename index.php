<?php
session_start();
require_once "BD/conexionBD.php";
require "Controladores/NombreUsuario.php";
require_once "Controladores/contenidoPrincipal.php";
$contenido = obtenerTodosLosDatos($conexion);
$usuario = recuerdaUsuario($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>CDA San Juan</title>
</head>

<body>
  <!-- Aqui es donde realizo la barra de navegaciones utilizando los ejemplos de bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="encabezado">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold" href="index.html"><img class="media-object rounded-circle" src="img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
      <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="Calendario_Competiciones.php">Calendario de Competiciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" id="texcab" href="Album.php">Albumes</a>
          </li>

          <?php
          if ($usuario && isset($usuario["Tipo"])) {
            if ($usuario["Tipo"] == "Entrenador" || $usuario["Tipo"] == "Atleta") {
          ?>
              <li class="nav-item">
                <a class="nav-link text-white-50" id="texcab" href="vistas/Atletas/Home_atletas.php">Home</a>
              </li>
          <?php
            } else {
              echo " ";
            }
          }
          ?>

          <?php
          if ($usuario && isset($usuario["Tipo"])) {
            if ($usuario["Tipo"] == "Administrador") {
          ?>
              <li class="nav-item">
                <a class="nav-link text-white-50" id="texcab" href="vistas/Administrador/Home.php">Home</a>
              </li>
          <?php }
          } ?>

          <?php if (empty($usuario)) { ?>
            <li class="nav-item">
              <a class="nav-link text-white-50" id="texcab" href="login.php">Iniciar Sesión</a>
            </li>
          <?php } ?>

        </ul>
        <?php if (!empty($usuario)) { ?>
          <div class="btn-group">
            <button type="button" class="btn  dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person"></i>
              <?php echo $usuario["Nombre_de_usuario"] . " (" . $usuario["Tipo"] . ")"; ?>
            </button>
            <ul class="dropdown-menu bg-dark w-100">
              <li><a class="dropdown-item text-white" id="prueba2" href="CerrarSession.php">Cerrar Sesión</a></li>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
  </nav>


  <!-- En esta parte es donde realizo todo el cuerpo de la pagina de inicio  -->

  <main class="container p-2">
    <div class="p-md-5 mb-4 rounded" id="fondo-principal">
      <div class="container text-center text-light" id="titulos">
        <div class="bg-dark p-2 rounded border border-success border-3 bg-gradient">
          <h1 id="txts">MAS QUE UN CLUB UNA FAMILIA</h1>
          <p>Persigue tus sueños de ser un deportista profesional junto a nosotros!</p>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="container-fluid ">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-dark bg-gradient">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="text-success">Visita Nuestros albumes</h3>
            <div class="mb-1 text-muted"><?php echo date('d-m-y')  ?></div>
            <p class="card-text text-white">Disfruta de las imagenes de nuestros mejores momento como equipo</p>
            <a href="Album.php" class="stretched-link">Ver albumes</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="img/equip2o.jpg" width="300" height="250" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="row g-5">
      <div class="col-md-8">

        <?php

        $datos = obtenerTodosLosDatos($conexion);

        // Mostrar los datos en el formato Bootstrap 5 con un bucle
        foreach ($datos as $fila) {
          echo '<h3 class="pb-1 p-lg-1 mb-4 fst-italic bg-dark text-light bg-gradient rounded text-decoration-underline">';
          echo isset($fila['titulo']) ? $fila['titulo'] : "ATLETA DE LA SEMANA";
          echo '</h3>';

          echo '<article class="blog-post">';
          echo '<h2>';
          echo isset($fila['sub_titulo']) ? $fila['sub_titulo'] : "Todavía no hay subtitulo";
          echo '</h2>';

          echo '<p>';
          echo isset($fila['contenido']) ? $fila['contenido'] : "Todavía no hay contenido";
          echo '</p>';

          // Mostrar la imagen (ajusta la ruta según tu configuración)
          echo '<img src="' . $fila['imagen'] . '" alt="Imagen" style="max-width: 50%;">';


          echo '<hr>';
          echo '</article>';
        }

        ?>

        <article class="blog-post">
          <hr>
          <h2 class="pb-1 p-lg-1 mb-4 fst-italic bg-dark text-light bg-gradient rounded text-decoration-underline">
            PATROCINADORES</h2>
          <img src="img/ayunta.jpg" alt="">
          <img src="img/logo-faguer.jpg" alt="">
          <img src="img/pancarta MAU LOA CAMPUS VERDES.jpg" width="20%" alt="">
      </div>

      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 text-white bg-dark bg-gradient  rounded">
            <h4 class="fst-italic text-decoration-underline">Sobre Nosotros</h4>
            <p class="mb-0">Somos un club de pueblo, con unos valores inquebrantables y un espiritu de lucha muy sanjuanero.
              nos encanta formar parte de este proyecto, de conseguir llevar el nombre de nuestro pueblo natal a todos los rincones de españa.
            </p>
            <p><a href="https://docs.google.com/forms/d/1BdaLSkBqoGzKzWz8zW2PSXgBHU3vadlqOpbmCW2WoNU/viewform?edit_requested=true" class="text-decoration-none fst-italic">INSCRIBETE!</a></p>
          </div>

          <div class="p-4 mt-3 bg-dark bg-gradient  rounded">
            <h4 class="fst-italic text-light text-decoration-underline">Siguenos!</h4>
            <ol class="list-unstyled ">
              <li><a class="text-decoration-underline text-white" href="https://www.instagram.com/cdatletismosanjuan/">Instagram</a></li>
              <li><a class="text-decoration-underline text-white" href="#">Twitter</a></li>
              <li><a class="text-decoration-underline text-white" href="#">Facebook</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- fin contenido -->

  <footer class="footer mt-auto py-3 bg-danger">
    <div class="container-fluid">
      <span class="text-white" id="letra">CDA San Juan De Aznalfarache | <span>Deny Enrique</span> </span>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>