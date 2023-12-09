<?php
session_start();
require_once "../BD/conexionBD.php";
require "NombreUsuario.php";
require "CrearUsuarios.php";
$usuario = recuerdaUsuario($conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Editar Usuarios</title>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="../../index.html"><img class="media-object rounded-circle" src="../img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
            <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="../Calendario_Competiciones.php">Calendario de
                            Competiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" id="texcab" href="../Album.php">Albumes</a>
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
                            <li><a class="dropdown-item text-white" id="prueba2" href="../login.php">Iniciar Sesion</a></li>
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
                        <li><a class="dropdown-item text-white" id="prueba" href="../index.html">Volver a inicio</a></li>

                        <li>
                            <hr class="dropdown-divider text-white">
                        </li>
                        <li><a class="dropdown-item text-white" id="prueba2" href="../CerrarSession.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- HEADER -->

    <?php
    // Verificar si se envió el formulario para actualizar los datos
    if (isset($_POST["guardar_cambios"])) {
        $id_usuario = $_POST["id_usuario"];
        $nombre_usuario = $_POST["Nombre_de_usuario"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $dni = $_POST["DNI"];
        $tipo = $_POST["Tipo"];

        // Actualizar los datos del usuario en la base de datos
        $sql = "UPDATE usuarios SET Nombre_de_usuario = :nombre_usuario, nombre = :nombre, apellidos = :apellidos, email = :email, DNI = :dni, Tipo = :tipo WHERE id_usuario = :id_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        header('location: ../vistas/Administrador/Home.php');
    }

    if (isset($_POST["id_usuario"])) {
        $id_usuario = $_POST["id_usuario"];

        // Realizar la consulta para obtener los datos del usuario por su ID
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

        // Mostrar los datos del usuario en un formulario si se encuentra
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <div class="container mt-5">
                <h2 class="mb-4">Editar Usuario</h2>
                <form method="POST" action="">
                    <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
                    <div class="mb-3">
                        <label for="Nombre_de_usuario" class="form-label">Nombre de Usuario:</label>
                        <input type="text" name="Nombre_de_usuario" value="<?php echo $row['Nombre_de_usuario']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="DNI" class="form-label">DNI:</label>
                        <input type="text" name="DNI" value="<?php echo $row['DNI']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Tipo" class="form-label">Tipo:</label>
                        <input type="text" name="Tipo" value="<?php echo $row['Tipo']; ?>" class="form-control">
                    </div>
                    <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" name="volver" class="btn btn-primary"><a href="../vistas/Administrador/Home.php" style="color: white; text-decoration: none;">Volver</a></button>
                </form>
            </div>
    <?php
        } else {
            echo "<p class='text-danger'>No se encontró ningún usuario con ese ID.</p>";
        }
    }
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>