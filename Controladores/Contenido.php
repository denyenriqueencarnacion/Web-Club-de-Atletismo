<?php
require_once "NombreUsuario.php";
function generarTarjetas($conexion)
{
    if (!empty($_POST["titulo"]) && isset($_POST["cantidad"])) {
        $titulo = $_POST["titulo"];
        $cantidad = $_POST["cantidad"];

        $textos = array();
        for ($i = 1; $i <= $cantidad; $i++) {
            if (isset($_POST["textoTarjeta$i"])) {
                $textos[] = $_POST["textoTarjeta$i"];
            }
        }

        $grupo = (!empty($_POST["grupo"])) ? $_POST["grupo"] : null;
        $msg = "";
        $sqlVerificar = "SELECT COUNT(*) AS count FROM contenido_atletas WHERE Titulo = :titulo";
        $stmtVerificar = $conexion->prepare($sqlVerificar);
        $stmtVerificar->bindParam(':titulo', $titulo);
        $stmtVerificar->execute();
        $result = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $msg = "El título ya está en uso, elija otro.";
        } else {
            $sql = "INSERT INTO contenido_atletas (Titulo, Cantidad_Tarjetas, Grupo, Contenido1, Contenido2, Contenido3, Contenido4, Contenido5, Contenido6) VALUES (:titulo, :cantidad, :grupo, :texto1, :texto2, :texto3, :texto4, :texto5, :texto6)";
            $smt = $conexion->prepare($sql);

            $smt->bindParam(':titulo', $titulo);
            $smt->bindParam(':cantidad', $cantidad);
            $smt->bindParam(':grupo', $grupo);
            for ($i = 0; $i < 6; $i++) {
                $contentIndex = $i + 1;
                if (isset($textos[$i])) {
                    $smt->bindParam(":texto$contentIndex", $textos[$i]);
                } else {
                    $placeholder = "";
                    $smt->bindParam(":texto$contentIndex", $placeholder);
                }
            }

            if ($smt->execute()) {
                $msg = "Datos de contenido de atleta registrados correctamente";
            } else {
                $msg = "No se ha podido registrar correctamente el contenido del atleta";
            }
        }

        echo '<p>' . $msg . '</p>';
    }

    $nombreUsuario = recuerdaUsuario($conexion)["Nombre_de_usuario"];

    // Obtener información del usuario actual
    $sqlUsuario = "SELECT Tipo FROM usuarios WHERE Nombre_de_usuario = :nombreUsuario";
    $stmtUsuario = $conexion->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':nombreUsuario', $nombreUsuario);
    $stmtUsuario->execute();
    $tipoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC)["Tipo"];
    $contentFound = false;

    if ($tipoUsuario === 'Atleta') {
        $sqlGrupoAtleta = "SELECT Grupo FROM atletas WHERE Nombre_de_usuario = :nombreUsuario";
        $stmtGrupoAtleta = $conexion->prepare($sqlGrupoAtleta);
        $stmtGrupoAtleta->bindParam(':nombreUsuario', $nombreUsuario);
        $stmtGrupoAtleta->execute();
        $resultadoAtleta = $stmtGrupoAtleta->fetch(PDO::FETCH_ASSOC);

        if ($resultadoAtleta) {
            $grupoUsuario = $resultadoAtleta["Grupo"];
        } else {
            // Manejar el caso en el que no se encuentran resultados para el atleta
            // Asignar un valor por defecto o manejar la situación según sea necesario
            $grupoUsuario = null; // O algún otro valor apropiado
        }
    } elseif ($tipoUsuario === 'Entrenador') {
        $sqlGrupoEntrenador = "SELECT id_grupo FROM entrenadores_grupos WHERE id_entrenador = (SELECT id_entrenador FROM entrenadores WHERE Nombre_de_usuario = :nombreUsuario)";
        $stmtGrupoEntrenador = $conexion->prepare($sqlGrupoEntrenador);
        $stmtGrupoEntrenador->bindParam(':nombreUsuario', $nombreUsuario);
        $stmtGrupoEntrenador->execute();
        $resultadoEntrenador = $stmtGrupoEntrenador->fetch(PDO::FETCH_ASSOC);

        if ($resultadoEntrenador) {
            $grupoUsuario = $resultadoEntrenador["id_grupo"];
        } else {
            // Manejar el caso en el que no se encuentran resultados para el entrenador
            // Asignar un valor por defecto o manejar la situación según sea necesario
            $grupoUsuario = null; // O algún otro valor apropiado
        }
    }


    // Mostrar bloques desde la base de datos para el grupo del usuario actual (atleta o entrenador)
    $sqlMostrar = "SELECT * FROM contenido_atletas WHERE Grupo = :grupoUsuario";
    $stmtMostrar = $conexion->prepare($sqlMostrar);
    $stmtMostrar->bindParam(':grupoUsuario', $grupoUsuario);
    $stmtMostrar->execute();

    while ($row = $stmtMostrar->fetch(PDO::FETCH_ASSOC)) {
        $titulo = $row['Titulo'];
        $cantidad = $row['Cantidad_Tarjetas'];
        $grupo = $row['Grupo'];

        $textos = array();
        for ($i = 1; $i <= $cantidad; $i++) {
            $content = $row["Contenido$i"];
            if (!empty($content)) {
                $textos[] = $content;
            }
        }

        // Generar bloques
        echo '<div class="container-fluid w-75 mt-2">
                <center>
                    <h1 class="pb-1 p-lg-1 bg-dark bg-gradient text-white rounded">' . $titulo . '</h1>
                </center>
                <div class="album py-5 ">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

        foreach ($textos as $texto) {
            echo '<div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Imagen" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Imagen</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">' . $texto . '</p>
                        </div>
                    </div>
                </div>';
        }

        echo '</div></div></div></div>';
        $contentFound = true;
    }
    // Si no se encontró contenido, mostrar el mensaje
    if (!$contentFound) {
        echo '<div class="container-fluid w-75 mt-2">
                <center>
                    <h1 class="pb-1 p-lg-1 bg-dark bg-gradient text-white rounded">AUN NO HAY CONTENIDO</h1>
                </center>
              </div>';
    }
}
