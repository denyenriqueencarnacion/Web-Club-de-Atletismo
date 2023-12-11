<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $editTitle = $_POST['editTitle'];
    $editContent = $_POST['editContent'];

    // Guardar los datos en cookies
    setcookie('editTitleCookie', $editTitle, time() + (86400 * 30), "/"); // Cookie válida por 30 días
    setcookie('editContentCookie', $editContent, time() + (86400 * 30), "/"); // Cookie válida por 30 días
    header("location: ../index.php");
}
?>
