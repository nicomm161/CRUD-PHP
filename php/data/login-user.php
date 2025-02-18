<?php
include("../../db/db.php");
include("../backend/user.php");

$control = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars(trim($_POST["user"]));
    $contrasena = htmlspecialchars(trim($_POST["password"]));
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if (empty($contrasena)) {
        echo "La contraseña no puede estar vacia";
        $control = false;   
    }

    if ($control) {
        // Verificar si el usuario está bloqueado
        $consulta = "SELECT estado FROM usuarios WHERE user = '$user'";
        $resultado = $conex->query($consulta);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['estado'] == 'bloqueado') {
                echo "El usuario está bloqueado y no puede iniciar sesión.";
                $control = false;
            }
        } else {
            echo "Usuario no encontrado.";
            $control = false;
        }
    }

    if ($control) {
        $nombre = "SELECT nombre FROM usuarios WHERE user = '$user'";
        $apellido = "SELECT apellido FROM usuarios WHERE user = '$user'";
        $dinero = "SELECT dinero FROM usuarios WHERE user = '$user'";
        $login_user = new Cliente($user, $contrasena, $nombre, $apellido, $dinero);
        $login_user->loginUser($user, $contrasena, $checkbox);
    }

    $conex->close();
}
?>
