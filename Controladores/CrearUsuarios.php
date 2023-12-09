<?php
function registrarUsuario($conexion)
{
    $msg = "";

    if (!empty($_POST["nombreUsuario"]) && !empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && !empty($_POST["email"]) && !empty($_POST["DNI"]) && !empty($_POST["password"]) && !empty($_POST["Telefono"]) && !empty($_POST["tipo"]) && !empty($_POST["tipo"])) {
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

            if ($smt->execute()) {
                switch ($_POST["tipo"]) {

                    case "Atleta":
                        // Código para insertar datos de Atleta
                        $sqlAtleta = "INSERT INTO atletas(Nombre_de_usuario, Grupo, Prueba_principal, Marca, Categoria) 
                                    VALUES (:nombreUsuario, :Grupo, :Prueba_principal, :Marca, :Categoria)";
                        $stmtAtleta = $conexion->prepare($sqlAtleta);

                        $stmtAtleta->bindParam(':nombreUsuario', $_POST["nombreUsuario"]);
                        $stmtAtleta->bindParam(':Grupo', $_POST["grupo"]);
                        $stmtAtleta->bindParam(':Prueba_principal', $_POST["prueba_principal"]);
                        $stmtAtleta->bindParam(':Marca', $_POST["marca"]);
                        $stmtAtleta->bindParam(':Categoria',  $_POST["categoria"]);

                        if ($stmtAtleta->execute()) {
                            $msg = "El usuario Atleta ha sido registrado correctamente";
                        } else {
                            $msg = "No se ha podido registrar correctamente al usuario Atleta";
                        }

                        break;

                    case "Entrenador":
                        // Código para insertar datos de Entrenador
                        $sqlEntrenador = "INSERT INTO entrenadores(Nombre_de_usuario, Descripción) 
                                        VALUES (:nombreUsuario, :Descripcion)";
                        $stmtEntrenador = $conexion->prepare($sqlEntrenador);

                        $stmtEntrenador->bindParam(':nombreUsuario', $_POST["nombreUsuario"]);
                        $stmtEntrenador->bindParam(':Descripcion', $_POST["descripcion"]);

                        if ($stmtEntrenador->execute()) {
                            $msg = "El usuario Entrenador ha sido registrado correctamente";
                        } else {
                            $msg = "No se ha podido registrar correctamente al usuario Entrenador";
                        }
                        break;
                }
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

    $sql = "SELECT id_usuario, Nombre_de_usuario, nombre, apellidos, email, DNI, Tipo FROM usuarios";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    echo '<table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Tipo</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <td>' . $row['Nombre_de_usuario'] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['apellidos'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['DNI'] . '</td>
                <td>' . $row['Tipo'] . '</td>
                <td>
                    <form action="../../Controladores/EditarUsuarios.php" method="POST">
                        <input type="hidden" name="id_usuario" value="' . $row['id_usuario'] . '"></input>
                        <input type="submit" class="btn btn-success w-100" value="Editar"></input>
                    </form>
                </td>
            </tr>';
    }
    echo '</tbody></table>';

    return $usuarios;
}
