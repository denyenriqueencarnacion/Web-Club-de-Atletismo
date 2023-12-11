<?php
session_start();
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroAdmin.php";
require "../../Controladores/NombreUsuario.php";
require "../../Controladores/CrearUsuarios.php";
require "../../Controladores/CrearGrupos.php";
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
    <title>Editar Grupos</title>
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
    // Verificar si se envió el formulario para eliminar el grupo
    if (isset($_POST["eliminar"])) {
        $id_grupo = $_POST["id_grupo"];

        // Eliminar registros relacionados en entrenador_grupos
        $sql_eliminar_entrenador_grupo = "DELETE FROM entrenadores_grupos WHERE id_grupo = :id_grupo";
        $stmt_eliminar_entrenador_grupo = $conexion->prepare($sql_eliminar_entrenador_grupo);
        $stmt_eliminar_entrenador_grupo->bindParam(':id_grupo', $id_grupo);
        $stmt_eliminar_entrenador_grupo->execute();

        // Eliminar el grupo de la tabla de grupos después de eliminar las relaciones
        $sql_eliminar_grupo = "DELETE FROM grupo WHERE id_grupo = :id_grupo";
        $stmt_eliminar_grupo = $conexion->prepare($sql_eliminar_grupo);
        $stmt_eliminar_grupo->bindParam(':id_grupo', $id_grupo);
        $stmt_eliminar_grupo->execute();

        header('location: Home.php');
    }


    if (isset($_POST["guardar_cambios"])) {
        $id_grupo = $_POST["id_grupo"];
        $nombre_grupo = $_POST["nombreGrupo"];
        $categoria = $_POST["categoria"];
        $horario = $_POST["horario"];
        $descripcion = $_POST["descripcion"];

        // Actualizar los datos del grupo en la base de datos
        $sql_actualizar_grupo = "UPDATE grupo SET Nombre_del_grupo = :nombre_grupo, Categoria = :categoria, Horario = :horario, Descripcion = :descripcion WHERE id_grupo = :id_grupo";
        $stmt_actualizar_grupo = $conexion->prepare($sql_actualizar_grupo);
        $stmt_actualizar_grupo->bindParam(':nombre_grupo', $nombre_grupo);
        $stmt_actualizar_grupo->bindParam(':categoria', $categoria);
        $stmt_actualizar_grupo->bindParam(':horario', $horario);
        $stmt_actualizar_grupo->bindParam(':descripcion', $descripcion);
        $stmt_actualizar_grupo->bindParam(':id_grupo', $id_grupo);
        $stmt_actualizar_grupo->execute();

        header('location: Home.php');
    }

    if (isset($_POST["id_grupo"])) {
        $id_grupo = $_POST["id_grupo"];

        // Realizar la consulta para obtener los datos del grupo por su ID
        $sql = "SELECT * FROM grupo WHERE id_grupo = :id_grupo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_grupo', $id_grupo);
        $stmt->execute();

        // Mostrar los datos del grupo en un formulario si se encuentra
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <div class="container mt-5">
                <h2 class="mb-4">Editar Grupo</h2>
                <form method="POST" action="">
                    <input type="hidden" name="id_grupo" value="<?php echo $row['id_grupo']; ?>">
                    <div class="mb-3">
                        <label for="nombreGrupo" class="form-label">Nombre del Grupo:</label>
                        <input type="text" class="form-control" id="nombreGrupo" name="nombreGrupo" value="<?php echo $row['Nombre_del_grupo']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $row['Categoria']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="horario" class="form-label">Rango horario:</label>
                        <input type="text" class="form-control" id="horario" name="horario" value="<?php echo $row['Horario']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo $row['Descripcion']; ?></textarea>
                    </div>

                    <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar Grupo</button>
                    <button type="button" name="volver" class="btn btn-primary"><a href="Home.php" style="color: white; text-decoration: none;">Volver</a></button>
                </form>
            </div>
    <?php
        } else {
            echo "<p class='text-danger'>No se encontró ningún grupo con ese ID.</p>";
        }
    }
    ?>


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>