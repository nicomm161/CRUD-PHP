<?php
include("../../db/db.php");
include("../backend/user.php");

$control = true;
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $dinero = $_POST['dinero'];
    $usuario = new Cliente($user, $password, $nombre, $apellido, $dinero);

    if (empty($nombre)) {
        echo "El nombre no puede estar vacio <br>";
        $control = false;
    }

    if (empty($apellido)) {
        echo "El apellido no puede estar vacio <br>";
        $control = false;
    }

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if (empty($password)) {
        echo "La contraseña no puede estar vacia";
        $control = false;
        
    }

    if ($control) {
        $usuario->registrarUser($nombre, $apellido, $user, $password, $dinero);
    }
    
}

?>