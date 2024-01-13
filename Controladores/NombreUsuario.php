<?php
function recuerdaUsuario($conexion) {
    if (isset($_SESSION['id_usuario'])) {
        $recuerda = $conexion->prepare('SELECT id_usuario, Nombre_de_usuario, Tipo FROM usuarios WHERE id_usuario=:id');
        $recuerda->bindParam(':id', $_SESSION['id_usuario']);
        $recuerda->execute();
        $resultado = $recuerda->fetch(PDO::FETCH_ASSOC);

        $usuario = null;

        if (count($resultado) > 0) {
            $usuario = $resultado;
        }
        return $usuario;
    }

    return null;
}

?>