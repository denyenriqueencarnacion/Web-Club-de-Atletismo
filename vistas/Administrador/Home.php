<?php
session_start();
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/NombreUsuario.php";
require "../../Controladores/CrearUsuarios.php";
require "../../Controladores/CrearGrupos.php";
// require"../../Controladores/EditarUsuarios.php";
$msg = registrarUsuario($conexion);
$msg2 = crearGrupos($conexion);
$msg3 = asignarEntrenadorAGrupo($conexion);
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
            <a class="navbar-brand text-white fw-bold" href="../../index.php"><img class="media-object rounded-circle" src="../../img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
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
                        <li><a class="dropdown-item text-white" id="prueba" href="../../index.php">Volver a inicio</a></li>

                        <li>
                            <hr class="dropdown-divider text-white">
                        </li>
                        <li><a class="dropdown-item text-white" id="prueba2" href="../../CerrarSession.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Botón para abrir la ventana modal -->
    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#instruccionesModal">
        Instrucciones
    </button>

    <!-- Ventana modal -->
    <div class="modal fade" id="instruccionesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instrucciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estos son los pasos a seguir para la creación del club:</p>
                    <p>Lo primero que vamos a hacer es crear los grupos. Después de crear los grupos, añadiremos los entrenadores. Una vez creados los entrenadores, asignaremos los grupos a cada entrenador. Finalmente, crearemos los atletas y a cada uno le asignaremos su grupo según su número, que podemos ver listado pulsando el botón "Editar grupo".</p>
                    <p>Recuerda, tu como administrador si vas a la pagina del calendario, puedes asignar eventos, y si vas a la pagina de albumes puedes generar albumes y enlazarles la carpeta de drive o cualquier sitio donde se encuentren las fotos</p>
                </div>
            </div>
        </div>
    </div>


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

        <!-- CREAR GRUPOS -->
        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR GRUPOS</h5>
                    <p class="card-text">Crea los grupos de entrenamientos que necesites</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#CrearGrupos" aria-expanded="false" aria-controls="collapseExample">
                        Crear Grupos
                    </button>

                    <div class="collapse mt-2" id="CrearGrupos">
                        <div class="card">

                            <div class="card-body">
                                <form action="" method="POST">

                                    <div class="mb-3">
                                        <label for="nombreGrupo" class="form-label">Nombre del Grupo:</label>
                                        <input type="text" class="form-control" id="nombreGrupo" name="nombreGrupo" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">Categoria:</label>
                                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="horario" class="form-label">Rango horario (ejemplo: 8:00 - 17:00):</label>
                                        <input type="text" class="form-control" id="horario" name="horario" placeholder="HH:MM - HH:MM" pattern="\d{1,2}:\d{2}\s-\s\d{1,2}:\d{2}" title="Introduce un rango horario válido (HH:MM - HH:MM)" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción:</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Registrar Grupo">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CREAR GRUPOS -->

        <!-- EDITAR GRUPOS -->
        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">EDITAR GRUPOS</h5>
                    <p class="card-text">Edita los datos que necesites de los grupos</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#EditarGrupos" aria-expanded="false" aria-controls="collapseExample">
                        Editar Grupos
                    </button>

                    <div class="collapse mt-2" id="EditarGrupos">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $grupos = obtenerGrupos($conexion);

                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- EDITAR GRUPOS -->

        <!-- ASIGNAR GRUPOS -->
        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ASIGNAR GRUPOS</h5>
                    <p class="card-text">Asigna los grupos de entrenamientos a los entrenadores que desees</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#AsignarGrupos" aria-expanded="false" aria-controls="collapseExample">
                        Asignar Grupo
                    </button>

                    <div class="collapse mt-2" id="AsignarGrupos">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST">

                                    <div class="mb-3">
                                        <label for="GrupoAsignado" class="form-label">Grupo de entrenamiento:</label>
                                        <select class="form-select" id="GrupoAsignado" name="GrupoAsignado" required>
                                            <?php
                                            // Obtener los nombres de los grupos y sus IDs desde la base de datos
                                            $sqlGrupos = "SELECT id_grupo, Nombre_del_grupo FROM grupo";
                                            $stmtGrupos = $conexion->prepare($sqlGrupos);
                                            $stmtGrupos->execute();

                                            while ($row = $stmtGrupos->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['id_grupo'] . '">' . $row['Nombre_del_grupo'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="EntrenadorGrupo" class="form-label">Entrenador para el grupo:</label>
                                        <select class="form-select" id="EntrenadorGrupo" name="EntrenadorGrupo" required>
                                            <?php
                                            // Obtener los nombres de los entrenadores y sus IDs desde la base de datos
                                            $sqlEntrenadores = "SELECT id_entrenador, Nombre_de_usuario FROM entrenadores";
                                            $stmtEntrenadores = $conexion->prepare($sqlEntrenadores);
                                            $stmtEntrenadores->execute();

                                            while ($row = $stmtEntrenadores->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['id_entrenador'] . '">' . $row['Nombre_de_usuario'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Registrar Grupo">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ASIGNAR GRUPOS -->

        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">MODIFICAR CONTENIDO</h5>
                    <p class="card-text">Haz clic para editar la página principal</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editarTexto">
                        Modificar
                    </button>

                    <div class="modal fade" id="editarTexto" tabindex="-1" aria-labelledby="editarTextoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarTextoLabel">Modificar página principal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../Controladores/contenidoPrincipal.php" method="post">

                                        <div class="mb-3">
                                            <label for="titulo1" class="form-label">Titulo 1:</label>
                                            <input type="text" class="form-control" id="titulo1" name="titulo1">
                                        </div>

                                        <div class="mb-3">
                                            <label for="subtitulo1" class="form-label">Subtitulo 1:</label>
                                            <input type="text" class="form-control" id="subtitulo1" name="subtitulo1">
                                        </div>

                                        <div class="mb-3">
                                            <label for="contenido1" class="form-label">Contenido 1:</label>
                                            <textarea class="form-control" id="contenido1" name="contenido1"></textarea>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <label for="titulo2" class="form-label">Titulo 2:</label>
                                            <input type="text" class="form-control" id="titulo2" name="titulo2">
                                        </div>

                                        <div class="mb-3">
                                            <label for="contenido2" class="form-label">Contenido 2:</label>
                                            <textarea class="form-control" id="contenido2" name="contenido2"></textarea>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <label for="titulo3" class="form-label">Titulo 3:</label>
                                            <input type="text" class="form-control" id="titulo3" name="titulo3">
                                        </div>

                                        <div class="mb-3">
                                            <label for="contenido3" class="form-label">Contenido 3:</label>
                                            <textarea class="form-control" id="contenido3" name="contenido3"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
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