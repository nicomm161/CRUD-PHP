<?php
include("../../db/db.php");
include("../backend/user.php");

$control = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = "SELECT nombre FROM usuarios WHERE user = '$user'";
    $apellido = "SELECT apellido FROM usuarios WHERE user = '$user'";
    $dinero = "SELECT dinero FROM usuarios WHERE user = '$user'";
    $user = htmlspecialchars(trim($_POST["user"]));
    $contrasena = htmlspecialchars(trim($_POST["password"]));
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';
    $login_user = new Cliente($user, $contrasena, $nombre, $apellido, $dinero);

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if (empty($contrasena)) {
        echo "La contraseña no puede estar vacia";
        $control = false;   
    }

    if ($control) {
        $login_user->loginUser($user, $contrasena, $checkbox);
    }

    $conex->close();
}
?>



