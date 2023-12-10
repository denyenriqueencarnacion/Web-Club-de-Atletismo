<?php
session_start();
//Filtro
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAtleta.php";

require "../../Controladores/NombreUsuario.php";
require "../../Controladores/Contenido.php";
$usuario = recuerdaUsuario($conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>

    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="encabezado">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="../../index.html"><img class="media-object rounded-circle" src="../../img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
            <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="../../Calendario_Competiciones.php">Calendario de
                            Competiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" id="texcab" href="../../Album.php">Albumes</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn  dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                        <?php if (!empty($usuario)) {
                            echo $usuario["Nombre_de_usuario"] . " (" . $usuario["Tipo"] . ")";
                        } ?>
                    </button>
                    <ul class="dropdown-menu bg-dark w-100">
                        <li><a class="dropdown-item text-white" id="prueba" href="../../index.html">Volver a inicio</a></li>

                        <li>
                            <hr class="dropdown-divider text-white">
                        </li>
                        <li><a class="dropdown-item text-white" id="prueba2" href="../../CerrarSession.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- HEADER -->

    <!-- Botón modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarModal">
        Crear Informacion
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Texto de Tarjeta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar el texto -->
                    <form action="" method="POST">

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad (máximo: 6)</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required max="6">
                        </div>

                        <div class="mb-3">
                            <label for="grupo" class="form-label">Grupo</label>
                            <input type="text" class="form-control" id="grupo" name="grupo" required>
                        </div>

                        <div class="mb-3" id="contenedor-texto">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    generarTarjetas($conexion);
    ?>

    <script src="../../js/ContenidoHomeUsers.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>