<?php
$server = "localhost";
$user = "root";
$pwd = "";
$db = "cda_sanjuan";
$conexion = new mysqli($server,$user,$pwd,$db);

// if($conexion->connect_error){
//     die("Conexion fallo: ".$conexion->connect_error);
// }
// $sql = "CREATE DATABASE cda_sanjuan";
// if($conexion->query($sql) === true){
//     echo "Creada Correctamente";
// }else{
//     die("Error al crear Base de datos ".$conexion->error);
// }

// Tabla Grupo
// $sql1 = "CREATE TABLE `grupos` (
//     `id_grupo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     `Nombre_grupo` varchar(100) NOT NULL,
//     `Horario` varchar(100) NOT NULL,
//     `entrenador` varchar(9) NOT NULL,
//     `atleta` varchar(200) NOT NULL
// )";

// if($conexion->query($sql1) === true){
//     echo "La tabla ha sido creada";
// } else {
//     die("Error al crear tabla: ".$conexion->error);
// }

// Tabla entrenadores
// $sql2 = "CREATE TABLE `entrenadores` (
//     `id_entrenador` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     `Nombre` varchar(100) NOT NULL,
//     `apellidos` varchar(100) NOT NULL,
//     `DNI` varchar(9) NOT NULL,
//     `email` varchar(100) NOT NULL,
//     `telefono` varchar(20),
//     `Password` varchar(200) NOT NULL,
//     `grupo` int(11) NOT NULL,
//     FOREIGN KEY(`grupo`) REFERENCES `grupos` (`id_grupo`)
// )";

// if($conexion->query($sql2) === true){
//     echo "La tabla ha sido creada";
// } else {
//     die("Error al crear tabla: ".$conexion->error);
// }

// Tabla Usuarios
$sql3 = "CREATE TABLE `usuarios` (
    `id_usuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Nombre_de_usuario` varchar(100) NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `apellidos` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(200) NOT NULL,
    `Tipo` varchar(100) NOT NULL
)";

if($conexion->query($sql3) === true){
    echo "La tabla ha sido creada";
} else {
    die("Error al crear tabla: ".$conexion->error);
}
?>