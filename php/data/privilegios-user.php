<?php

include("../../db/db.php");
include("../backend/user.php");

$control = true;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $password = "SELECT password FROM usuarios WHERE user = '$user'";
    $nombre = "SELECT nombre FROM usuarios WHERE user = '$user'";
    $apellido = "SELECT apellido FROM usuarios WHERE user = '$user'";
    $dinero = "SELECT dinero FROM usuarios WHERE user = '$user'";
    $usuario_modificar = new Admin($user, $password, $nombre, $apellido, $dinero);

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if ($control) {
        $usuario_modificar->privilegiosUser($user);
    }
}

?>