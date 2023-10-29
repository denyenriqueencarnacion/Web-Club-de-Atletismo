<?php
session_start();
//Filtro
require_once "../../BD/conexionBD.php";
require_once "../../Filtros/FiltroEntrenador.php";

$authManager = new AuthorizationManager(['Entrenador']);
$userType = null;

if (isset($_SESSION['id_usuario'])) {
    $recuerda = $conexion->prepare('SELECT Tipo FROM usuarios WHERE id_usuario = :id_usuario');
    $recuerda->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $recuerda->execute();
    $userType = $recuerda->fetchColumn();
}

if (!$authManager->checkAuthorization($userType)) {
    $authManager->redirectUnauthorized("../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Entrenadores</h1>
    <a href="../../index.html">Volver</a>
    <a href="../../CerrarSession.php">Cerrar Sesion</a>

</body>
</html>