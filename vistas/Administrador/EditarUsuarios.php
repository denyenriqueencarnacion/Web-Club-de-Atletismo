<?php
session_start();
require_once "../../BD/conexionBD.php";
require "../../Controladores/NombreUsuario.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/CrearUsuarios.php";
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
                        <li><a class="dropdown-item text-white" id="prueba" href="../index.php">Volver a inicio</a></li>

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
        header('location: Home.php');
    }

    // ELIMINAR USUARIOS
    if (isset($_POST["eliminar"])) {
        $id_usuario = $_POST["id_usuario"];

        // Verificar si el usuario es un entrenador
        $sql_verificar_entrenador = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt_verificar_entrenador = $conexion->prepare($sql_verificar_entrenador);
        $stmt_verificar_entrenador->bindParam(':id_usuario', $id_usuario);
        $stmt_verificar_entrenador->execute();
        $es_entrenador = $stmt_verificar_entrenador->rowCount() > 0;

        // Verificar si el usuario es un atleta
        $sql_verificar_atleta = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND Tipo = 'Atleta'";
        $stmt_verificar_atleta = $conexion->prepare($sql_verificar_atleta);
        $stmt_verificar_atleta->bindParam(':id_usuario', $id_usuario);
        $stmt_verificar_atleta->execute();
        $es_atleta = $stmt_verificar_atleta->rowCount() > 0;

        // Si es un entrenador, eliminar primero de la tabla de entrenadores_grupos
        if ($es_entrenador) {
            // Obtener el Nombre_de_usuario asociado al id_usuario
            $sql_obtener_nombre_entrenador = "SELECT Nombre_de_usuario FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt_obtener_nombre_entrenador = $conexion->prepare($sql_obtener_nombre_entrenador);
            $stmt_obtener_nombre_entrenador->bindParam(':id_usuario', $id_usuario);
            $stmt_obtener_nombre_entrenador->execute();
            $row_nombre_entrenador = $stmt_obtener_nombre_entrenador->fetch(PDO::FETCH_ASSOC);
            $nombre_usuario = $row_nombre_entrenador['Nombre_de_usuario'];

            // Obtener el id_entrenador asociado al id_usuario
            $sql_obtener_id_entrenador = "SELECT id_entrenador FROM entrenadores WHERE Nombre_de_usuario = :nombre_usuario";
            $stmt_obtener_id_entrenador = $conexion->prepare($sql_obtener_id_entrenador);
            $stmt_obtener_id_entrenador->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt_obtener_id_entrenador->execute();
            $row_id_entrenador = $stmt_obtener_id_entrenador->fetch(PDO::FETCH_ASSOC);
            $id_entrenador = $row_id_entrenador['id_entrenador'];

            // Eliminar del grupo en entrenadores_grupos
            $sql_eliminar_entrenador_grupo = "UPDATE entrenadores_grupos SET id_entrenador = NULL WHERE id_entrenador = :id_entrenador";
            $stmt_eliminar_entrenador_grupo = $conexion->prepare($sql_eliminar_entrenador_grupo);
            $stmt_eliminar_entrenador_grupo->bindParam(':id_entrenador', $id_entrenador);
            $stmt_eliminar_entrenador_grupo->execute();

            // Eliminar de la tabla de entrenadores
            $sql_eliminar_entrenador = "DELETE FROM entrenadores WHERE Nombre_de_usuario = :nombre_usuario";
            $stmt_eliminar_entrenador = $conexion->prepare($sql_eliminar_entrenador);
            $stmt_eliminar_entrenador->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt_eliminar_entrenador->execute();
        }

        // Si es un atleta, eliminar primero de la tabla de atletas
        if ($es_atleta) {
            $sql_eliminar_atleta = "DELETE FROM atletas WHERE Nombre_de_usuario IN (SELECT Nombre_de_usuario FROM usuarios WHERE id_usuario = :id_usuario)";
            $stmt_eliminar_atleta = $conexion->prepare($sql_eliminar_atleta);
            $stmt_eliminar_atleta->bindParam(':id_usuario', $id_usuario);
            $stmt_eliminar_atleta->execute();
        }

        // Eliminar el usuario de la tabla de usuarios
        $sql_eliminar_usuario = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt_eliminar_usuario = $conexion->prepare($sql_eliminar_usuario);
        $stmt_eliminar_usuario->bindParam(':id_usuario', $id_usuario);
        $stmt_eliminar_usuario->execute();

        header('location: Home.php');
    }

    //ELIMINAR USUARIOS


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
                        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" attern="[A-Za-z]+" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control" attern="[A-Za-z]+" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,} required>
                    </div>
                    <div class="mb-3">
                        <label for="DNI" class="form-label">DNI:</label>
                        <input type="text" name="DNI" value="<?php echo $row['DNI']; ?>" class="form-control" pattern="\d{8}[a-zA-Z]" required>
                    </div>
                    <div class="mb-3">
                        <label for="Tipo" class="form-label">Tipo:</label>
                        <input type="text" name="Tipo" value="<?php echo $row['Tipo']; ?>" class="form-control" required>
                    </div>
                    <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar Usuarios</button>
                    <button type="button" name="volver" class="btn btn-primary"><a href="Home.php" style="color: white; text-decoration: none;">Volver</a></button>
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