<?php
$server = "localhost";
$user = "root";
$pwd = "";
$db = "cda_sanjuan";

try{
    $conexion = new PDO("mysql:host=$server;dbname=$db;",$user,$pwd);
}catch(PDOException $e){
    die("ha fallado la conexion: ".$e->getMessage());
}

?>