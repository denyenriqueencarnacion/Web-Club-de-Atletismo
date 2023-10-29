<?php
session_start();
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/NombreUsuario.php";
require_once "../../Controladores/CrearUsuarios.php";
$usuario = recuerdaUsuario($conexion);
// $tablaUsuarios = obtenerUsuarios($conexion);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nombreUsuario"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["email"]) && isset($_POST["DNI"]) && isset($_POST["password"]) && isset($_POST["Telefono"]) && isset($_POST["tipo"])) {
    // Llama a la función registrarUsuario y pasa la conexión como argumento
    $mensaje = registrarUsuario($conexion);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <!-- <link rel="stylesheet" href="../../css/styles3.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Crear usuarios</title>
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

    <!-- offcanvas -->
    <!-- <div class="container-fluid">
        <div class="row"> -->
    <!-- Sidebar -->
    <!-- <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column"> -->
    <!-- Contenido del sidebar -->
    <!-- <li class="nav-item">
                            <a class="nav-link active" href="Home.php">
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

    <!-- Formulario -->
    <!-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4  "> -->
    <!-- <center>
                    <h1>Crear Usuarios</h1>
                </center> -->
    <!-- </main> -->

    <!-- </div> -->
    <!-- </div> -->
    <!-- offcanvas -->
    <div class="card alert-danger">
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
    <div class="container mt-5">
        <div class="row">
            <!-- Primer formulario -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Crear Usuarios
                    </div>
                    <div class="card-body">
                        <form action="CrearUsuarios.php" method="post" class="needs-validation" id="formulario" novalidate>
                            <div class="mb-2">
                                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="DNI" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="DNI" name="DNI" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" pattern=".{8,}" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="Telefono" class="form-label">Telefono</label>
                                <input type="Text" class="form-control" id="Telefono" name="Telefono" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="tipo" name="tipo" hidden>
                                    <option value="Atleta" selected>Atleta</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>

                            <!-- Boton Lista de usuarios -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver usuarios</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Usuarios</h5>
                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body w-100 table-responsive">
                                            <?php
                                            echo $tablaUsuarios;
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Segundo formulario -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Crear Entrenador y Grupo de Entrenamiento
                    </div>
                    <div class="card-body">
                        <form action="CrearUsuarios.php" method="post" class="needs-validation" id="formulario" novalidate>
                            <div class="mb-2">
                                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="DNI" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="DNI" name="DNI" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" pattern=".{8,}" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="Telefono" class="form-label">Telefono</label>
                                <input type="Text" class="form-control" id="Telefono" name="Telefono" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="tipo" name="tipo" hidden>
                                    <option value="Entrenador" selected>Entrenador</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>

                            <!-- Boton Lista de usuarios -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver usuarios</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Usuarios</h5>
                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body w-100 table-responsive">
                                            <?php
                                            echo $tablaUsuarios;
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>