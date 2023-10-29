<?php
session_start();
require_once "../BD/conexionBD.php";

if (isset($_SESSION['id_usuario'])) {
    $recuerda = $conexion->prepare('SELECT id_usuario, Nombre_de_usuario, Tipo FROM usuarios WHERE id_usuario=:id_usuario');
    $recuerda->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $recuerda->execute();
    $resultado = $recuerda->fetch(PDO::FETCH_ASSOC);
  
    $usuario = null;
  
    if (count($resultado) > 0) {
      $usuario = $resultado;
    }
  }
  switch ($usuario["Tipo"]) {
    case "Administrador":
        header("location: ../vistas/Administrador/Home.php");
        break;
    case "Atleta":
        header("location: ../vistas/Atletas/Home_atletas.php");
        break;
    case "Entrenador":
        header("location: ../vistas/Entrenador/HomeEntrenador.php");
        break;
    default:
        header("location: ../login.php");
        break;
}
