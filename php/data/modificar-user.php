<?php
include("../../db/db.php");
include("../backend/user.php");

$control = true;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $user_modificar = $_POST['user'];
    $password_modificar = $_POST['password'];
    $nombre = "SELECT nombre FROM usuarios WHERE user = '$user_modificar'";
    $apellido = "SELECT apellido FROM usuarios WHERE user = '$user_modificar'";
    $dinero = "SELECT dinero FROM usuarios WHERE user = '$user_modificar'";
    $usuario_modificar = new Cliente($user_modificar, $password_modificar, $nombre, $apellido, $dinero);

    if (empty($user_modificar)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if (empty($password_modificar)) {
        echo "La contraseña no puede estar vacia";
        $control = false;
    }

    if ($control) {
        $usuario_modificar->modificarUser($user_modificar, $password_modificar);
    }
}



?>