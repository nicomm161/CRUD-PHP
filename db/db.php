<?php

$user = "root";
$pass = "";
$server = "localhost";
$db = "tienda";


$conex = new mysqli($server, $user, $pass, $db);

if($conex->connect_error){
    die("Error en la conexion: " . $conex->connect_error);
}

?>