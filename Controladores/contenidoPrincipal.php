<?php
function actualizarTexto() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar y establecer cada valor en cookies individuales
        if (isset($_POST['titulo1'])) {
            setcookie('titulo1', $_POST['titulo1'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['subtitulo1'])) {
            setcookie('subtitulo1', $_POST['subtitulo1'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['contenido1'])) {
            setcookie('contenido1', $_POST['contenido1'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['titulo2'])) {
            setcookie('titulo2', $_POST['titulo2'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['contenido2'])) {
            setcookie('contenido2', $_POST['contenido2'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['titulo3'])) {
            setcookie('titulo3', $_POST['titulo3'], time() + (86400 * 30), '/');
        }
        if (isset($_POST['contenido3'])) {
            setcookie('contenido3', $_POST['contenido3'], time() + (86400 * 30), '/');
        }

        // Redireccionar a la página principal o donde se muestra el texto
        header('Location: ../index.php'); // Cambia 'index.php' por tu página principal
        exit();
    }
}

// Llamar a la función para procesar el formulario
actualizarTexto();
?>
