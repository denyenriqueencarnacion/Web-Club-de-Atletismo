<?php
function registrarUsuario($conexion)
{
    $msg = "";

    if (!empty($_POST["nombreUsuario"]) && !empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && !empty($_POST["email"]) && !empty($_POST["DNI"]) && !empty($_POST["password"]) && !empty($_POST["Telefono"]) && !empty($_POST["tipo"])) {
        // Verificar si el nombre de usuario ya existe
        $nombreUsuario = $_POST["nombreUsuario"];
        $sqlVerificar = "SELECT COUNT(*) AS count FROM usuarios WHERE Nombre_de_usuario = :nombreUsuario";
        $stmtVerificar = $conexion->prepare($sqlVerificar);
        $stmtVerificar->bindParam(':nombreUsuario', $nombreUsuario);
        $stmtVerificar->execute();
        $result = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $msg = "El nombre de usuario ya está en uso, elija otro.";
        } else {
            // Si el nombre de usuario no existe, proceder con la inserción
            $sql = "INSERT INTO usuarios(Nombre_de_usuario, nombre, apellidos, email, DNI, password, Telefono, Tipo) VALUES (:nombreUsuario, :nombre, :apellidos, :email, :DNI, :password, :Telefono, :tipo)";
            $smt = $conexion->prepare($sql);
            $passw = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $smt->bindParam(':nombreUsuario', $_POST["nombreUsuario"]);
            $smt->bindParam(':nombre', $_POST["nombre"]);
            $smt->bindParam(':apellidos', $_POST["apellidos"]);
            $smt->bindParam(':email', $_POST["email"]);
            $smt->bindParam(':DNI', $_POST["DNI"]);
            $smt->bindParam(':password', $passw);
            $smt->bindParam(':Telefono', $_POST["Telefono"]);
            $smt->bindParam(':tipo', $_POST["tipo"]);

            // switch ($_POST["tipo"]) {
            //     case "Atleta":
            //         $nombreUsuario = $_POST["nombreUsuario"];

            //         $sql = "INSERT INTO atletas(Nombre_de_usuario, Grupo, Prueba_principal, Marca, Categoria) 
            //                 VALUES (:nombreUsuario, :Grupo, :Prueba_principal, :Marca, :Categoria)";
            //         $smt = $conexion->prepare($sql);


            //         $smt->bindParam(':nombreUsuario', $_POST["nombreUsuario"]);
            //         $smt->bindParam(':Grupo', $_POST["Grupo"]);
            //         $smt->bindParam(':Prueba_principal', $_POST["Prueba_principal"]);
            //         $smt->bindParam(':Marca', $_POST["Marca"]);
            //         $smt->bindParam(':Categoria',  $_POST["Categoria"]);

            //         break;

            //     case "Entrenador":
            //         $sql = "INSERT INTO entrenadores(Nombre_de_usuario, Descripción) 
            //                 VALUES (:nombreUsuario, :Descripción)";
            //         $smt = $conexion->prepare($sql);

            //         $smt->bindParam(':nombreUsuario', $_POST["nombreUsuario"]);
            //         $smt->bindParam(':Descripción', $_POST["Descripcion"]);

            //         break;
            // }

            if ($smt->execute()) {
                $msg = "El usuario ha sido registrado correctamente";
            } else {
                $msg = "No se ha podido registrar correctamente su usuario";
            }
        }
    }
    return $msg;
}

function obtenerUsuarios($conexion)
{
    $usuarios = array();

    $sql = "SELECT Nombre_de_usuario, nombre, apellidos, email, DNI, Tipo FROM usuarios";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = $row;
    }

    return $usuarios;
}


// function obtenerDatosUsuariosPorMes($conexion) {
    
    
//     $recuerda = $conexion->prepare('SELECT Nombre_de_usuario FROM usuarios where Tipo = "Atleta"');
//     $recuerda->execute();
//     $resultado = $recuerda->fetchAll(PDO::FETCH_ASSOC);
//     $datos = $resultado;
    
//     return count($datos);
// }
