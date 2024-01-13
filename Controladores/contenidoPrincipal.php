<?php
function actualizarTexto($conexion)
{
    // Verificar y establecer cada valor en la base de datos
    if (!empty($_POST['titulo1']) && !empty($_POST['subtitulo1']) && !empty($_POST['contenido1'])) {
        $titulo1 = htmlspecialchars(trim($_POST['titulo1']));
        $subtitulo1 = htmlspecialchars(trim($_POST['subtitulo1']));
        $contenido1 = htmlspecialchars(trim($_POST['contenido1']));
    
        // Manejar la subida de la imagen
        $imagen = $_FILES['imagen'];
    
        // Verificar si se ha cargado una imagen
        if ($imagen['error'] == UPLOAD_ERR_OK) {
            // Ruta donde se almacenarán las imágenes (ajusta esto según tu estructura)
            $rutaAlmacenamiento ='../../fotos/';
    
            // Generar un nombre único para la imagen
            $nombreImagen = uniqid('imagen_') . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
    
            // Mover la imagen a la ruta de almacenamiento
            move_uploaded_file($imagen['tmp_name'], $rutaAlmacenamiento . $nombreImagen);
            $imagenprueba="fotos/".$nombreImagen;
            // Insertar datos en la tabla 'contenido_inicio'
            $sql = "INSERT INTO contenido_inicio (titulo, sub_titulo, contenido, imagen) VALUES (:titulo, :sub_titulo, :contenido, :imagen)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':titulo', $titulo1);
            $stmt->bindParam(':sub_titulo', $subtitulo1);
            $stmt->bindParam(':contenido', $contenido1);
            $stmt->bindParam(':imagen', $imagenprueba);
            $stmt->execute();
    
            header("location: ../../index.php");
        } else {
            echo "Error al subir la imagen.";
        }
    }
    
}


function obtenerTodosLosDatos($conexion)
{
    try {
        // Preparar la consulta SQL para obtener todos los datos de la tabla 'contenido_inicio'
        $sql = "SELECT * FROM contenido_inicio";
        $stmt = $conexion->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener y devolver todos los datos como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejar cualquier error de la base de datos
        echo "Error al obtener datos: " . $e->getMessage();
    }
}

function vaciarContenidoInicio($conexion) {
    if(isset($_POST["eliminarcontenido"])){
    
    try {
        // Preparar la consulta SQL para eliminar todos los registros de la tabla 'contenido_inicio'
        $sql = "DELETE FROM contenido_inicio";
        $stmt = $conexion->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Mensaje de éxito
        header("location: ../../index.php");
    } catch (PDOException $e) {
        // Manejar cualquier error de la base de datos
        echo "Error al eliminar el contenido de la tabla 'contenido_inicio': " . $e->getMessage();
    }
}
}

// Uso de la función para vaciar la tabla 'contenido_inicio'

