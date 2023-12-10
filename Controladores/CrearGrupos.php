<?php
function crearGrupos($conexion)
{
    $msg = "";

    if (!empty($_POST["nombreGrupo"]) && !empty($_POST["categoria"]) && !empty($_POST["horario"]) && !empty($_POST["descripcion"])) {
        // Obtener datos del formulario
        $nombreGrupo = $_POST["nombreGrupo"];
        $categoria = $_POST["categoria"];
        $horario = $_POST["horario"];
        $descripcion = $_POST["descripcion"];

        // Consulta SQL para insertar los datos en la tabla de grupos
        $sqlInsertGrupo = "INSERT INTO grupo (Nombre_del_grupo, Categoria, Horario, Descripcion) VALUES (:nombreGrupo, :categoria, :horario, :descripcion)";
        $stmtInsertGrupo = $conexion->prepare($sqlInsertGrupo);
        $stmtInsertGrupo->bindParam(':nombreGrupo', $nombreGrupo);
        $stmtInsertGrupo->bindParam(':categoria', $categoria);
        $stmtInsertGrupo->bindParam(':horario', $horario);
        $stmtInsertGrupo->bindParam(':descripcion', $descripcion);

        // Ejecutar la consulta para crear el grupo
        if ($stmtInsertGrupo->execute()) {
            $msg = "El grupo ha sido creado correctamente";
        } else {
            $msg = "Hubo un problema al crear el grupo";
        }
    } else {
        $msg = "Por favor, complete todos los campos del formulario";
    }

    return $msg;
}

function obtenerGrupos($conexion)
{
    $grupos = array();

    $sql = "SELECT id_grupo, Nombre_del_grupo, Categoria, Horario, Descripcion FROM grupo";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    echo '<table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Numero del Grupo</th>
                    <th>Nombre del Grupo</th>
                    <th>Categoría</th>
                    <th>Horario</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <td>' . $row['id_grupo'] . '</td>
                <td>' . $row['Nombre_del_grupo'] . '</td>
                <td>' . $row['Categoria'] . '</td>
                <td>' . $row['Horario'] . '</td>
                <td>' . $row['Descripcion'] . '</td>
                <td>
                    <form action="EditarGrupos.php" method="POST">
                        <input type="hidden" name="id_grupo" value="' . $row['id_grupo'] . '"></input>
                        <input type="submit" class="btn btn-success w-100" value="Editar"></input>
                    </form>
                </td>
            </tr>';
    }
    echo '</tbody></table>';

    return $grupos;
}

function asignarEntrenadorAGrupo($conexion)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['GrupoAsignado']) && isset($_POST['EntrenadorGrupo'])) {
            $id_grupo = $_POST['GrupoAsignado'];
            $id_entrenador = $_POST['EntrenadorGrupo'];

            // Consulta SQL para insertar los datos en la tabla de relación entrenadores_grupos
            $sqlInsertRelacion = "INSERT INTO entrenadores_grupos (id_entrenador, id_grupo) VALUES (:id_entrenador, :id_grupo)";
            $stmtInsertRelacion = $conexion->prepare($sqlInsertRelacion);
            $stmtInsertRelacion->bindParam(':id_entrenador', $id_entrenador);
            $stmtInsertRelacion->bindParam(':id_grupo', $id_grupo);

            // Ejecutar la consulta para crear la relación
            if ($stmtInsertRelacion->execute()) {
                return "La relación entre el grupo y el entrenador ha sido creada correctamente";
            } else {
                return "Hubo un problema al crear la relación entre el grupo y el entrenador";
            }
        } else {
            return "Por favor, completa todos los campos del formulario";
        }
    } else {
        return "No se ha enviado el formulario";
    }
}

?>