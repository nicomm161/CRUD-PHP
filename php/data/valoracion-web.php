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
    $valoracion = $_POST['valoracion'];
    $comentario = $_POST['comentario'];

    $valoracion_web = new Cliente($user, $password, $nombre, $apellido, $dinero);

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if ($valoracion < 0 || empty($valoracion)) {
        echo "La valoracion no es correcta <br>";
        $control = false;
    }

    if (empty($comentario)) {
        echo "El comentario no puede estar vacio <br>";
        $control = false;
    }

    if ($control) {
        $valoracion_web->valoracionWeb($user, $valoracion, $comentario);
    }
}

?>