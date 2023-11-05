<?php
session_start();
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/NombreUsuario.php";
require "../../Controladores/CrearUsuarios.php";
$datos = obtenerDatosUsuariosPorMes($conexion);
$usuario = recuerdaUsuario($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/styles3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Administracion</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="../../index.html"><img class="media-object rounded-circle" src="../../img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
            <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="Calendario.html">Calendario de
                            Competiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" id="texcab" href="album.html">Albumes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white-50" id="texcab" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Club
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-white" id="prueba" href="#">Historia</a></li>
                            <li><a class="dropdown-item text-white" id="prueba" href="#">Entrenadores</a></li>
                            <li><a class="dropdown-item text-white" id="prueba" href="Administrar.html">Administrar</a></li>
                            <li>
                            <li>
                                <hr class="dropdown-divider bg-light">
                            </li>
                            <li><a class="dropdown-item text-white" id="prueba2" href="../../login.php">Iniciar Sesion</a></li>
                            <li><a class="dropdown-item text-white" id="prueba2" href="#">Horarios</a></li>
                            <li><a class="dropdown-item text-white" id="prueba2" href="Rankings.html">Rankigs</a></li>
                        </ul>
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
        
    <button class="btn btn-success mt-2 m-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Listado de Usuarios
    </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre de Usuario</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>DNI</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usuarios = obtenerUsuarios($conexion);

                            foreach ($usuarios as $usuario) {
                                echo '<tr>
                                <td>' . $usuario['Nombre_de_usuario'] . '</td>
                                <td>' . $usuario['nombre'] . '</td>
                                <td>' . $usuario['apellidos'] . '</td>
                                <td>' . $usuario['email'] . '</td>
                                <td>' . $usuario['DNI'] . '</td>
                                <td>' . $usuario['Tipo'] . '</td>
                            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR USUARIOS-ATLETAS</h5>
                    <p class="card-text">Crea Atletas y Asignales el Grupo de entrenamiento que necesite</p>
                    <a href="#" class="btn btn-primary">Crear Usuario</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR USUARIOS-ENTRENADORES</h5>
                    <p class="card-text">Crea entrenadores y Asignales el grupo de entrenamiento que consideres </p>
                    <a href="#" class="btn btn-primary">Crear Entrenador</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR GRUPOS DE ENTRENAMIENTOS</h5>
                    <p class="card-text">Crea Grupos de entrenamientos, asignales un horario y Categoria </p>
                    <a href="#" class="btn btn-primary">Crear Grupo de Entrenamiento</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ADMINISTRAR CALENDARIO</h5>
                    <p class="card-text">Crea Eventos y Asigna Fechas en el calendario  </p>
                    <a href="#" class="btn btn-primary">Crear Eventos</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ADMINISTRAR ALBUM</h5>
                    <p class="card-text">Crea Albumes, y asignales una descripcion </p>
                    <a href="#" class="btn btn-primary">Crear Album</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">EDITAR USUARIOS</h5>
                    <p class="card-text">Edita la informacion de los usuarios </p>
                    <a href="#" class="btn btn-primary">Editar Usuarios</a>
                </div>
            </div>
        </div>
    </div>
    
    
   

    <!-- offcanvas -->
    <!-- <div class="container-fluid">
        <div class="row"> -->
            <!-- Sidebar -->
            <!-- <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column"> -->
                        <!-- Contenido del sidebar -->
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-images"></i> Albumes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="CrearUsuarios.php">
                                <i class="bi bi-person"></i> Crear usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-calendar-check"></i> Calendario
                            </a>
                        </li>
                    </ul>
                </div>
            </nav> -->

            <!-- Contenido principal -->
            
        <!-- </div> -->
    <!-- </div> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>