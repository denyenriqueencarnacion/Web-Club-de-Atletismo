<?php
session_start();
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/NombreUsuario.php";
require "../../Controladores/CrearUsuarios.php";
// require"../../Controladores/EditarUsuarios.php";
$msg = registrarUsuario($conexion);
$usuario = recuerdaUsuario($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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
                        <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="../../Calendario_Competiciones.php">Calendario de
                            Competiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" id="texcab" href="../../Album.php">Albumes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white-50" id="texcab" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Club
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-white" id="prueba" href="#">Historia</a></li>
                            <li><a class="dropdown-item text-white" id="prueba" href="#">Entrenadores</a></li>
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

    <div class="container-fluid row mt-2">
        <?php if (!empty($msg)) {
            echo '<div class="alert alert-info mt-3" role="alert">' . $msg . '</div>';
        }
        ?>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR USUARIOS</h5>
                    <p class="card-text">Crea Usuarios y Asignales el Grupo de entrenamiento que necesite</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#CrearUsuarios" aria-expanded="false" aria-controls="collapseExample">
                        Crear Usuarios
                    </button>

                    <div class="collapse mt-2" id="CrearUsuarios">
                        <div class="card">

                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="nombreUsuario" class="form-label">Nombre de Usuario:</label>
                                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" pattern="^[a-zA-Z0-9_]{3,20}$" required>
                                        <div class="invalid-feedback">
                                            Ingresa un nombre de usuario válido.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="apellidos" class="form-label">Apellidos:</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="DNI" class="form-label">DNI:</label>
                                        <input type="text" class="form-control" id="DNI" name="DNI" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password" pattern="^.{8,}$" required>
                                        <div class="invalid-feedback">
                                            La contraseña debe tener al menos 8 caracteres.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Telefono" class="form-label">Teléfono:</label>
                                        <input type="tel" class="form-control" id="Telefono" name="Telefono" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo:</label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                            <option value="Atleta">Atleta</option>
                                            <option value="Entrenador">Entrenador</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" id="Descripcion" style="display: none;">
                                        <label for="descripcion" class="form-label">Descripción:</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                    </div>

                                    <div class="mb-3" id="grupo" style="display: none;">
                                        <label for="grupo" class="form-label">Grupo:</label>
                                        <input type="text" class="form-control" id="grupo" name="grupo">
                                    </div>

                                    <div class="mb-3" id="prueba_principal" style="display: none;">
                                        <label for="prueba_principal" class="form-label">Prueba Principal:</label>
                                        <input type="text" class="form-control" id="prueba_principal" name="prueba_principal">
                                    </div>

                                    <div class="mb-3" id="marca" style="display: none;">
                                        <label for="marca" class="form-label">Marca:</label>
                                        <input type="text" class="form-control" id="marca" name="marca">
                                    </div>

                                    <div class="mb-3" id="categoria" style="display: none;">
                                        <label for="categoria" class="form-label">Categoria:</label>
                                        <input type="text" class="form-control" id="categoria" name="categoria">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Registrar Usuarios">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">EDITAR USUARIOS</h5>
                    <p class="card-text">Edita los datos que necesites de los usuarios</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#EditarUsuarios" aria-expanded="false" aria-controls="collapseExample">
                        Editar Usuarios
                    </button>

                    <div class="collapse mt-2" id="EditarUsuarios">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $usuarios = obtenerUsuarios($conexion);

                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../js/Formulario.js"></script>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>