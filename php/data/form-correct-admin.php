<?php
session_start();
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
        $consulta = "SELECT estado, privilegios FROM usuarios WHERE user = '$user'";
        $resultado = $conex->query($consulta);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['estado'] == 'bloqueado') {
                echo "El usuario está bloqueado y no puede iniciar sesión. <br>";
                echo "Contacte con el administrador";
                $control = false;
            } elseif ($fila['privilegios'] != 'admin') {
                echo "El usuario no tiene privilegios de administrador. <br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
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

        // Redirigir al panel de administrador si el usuario tiene privilegios de administrador
        if ($_SESSION['role'] == 'admin') {
            header("Location: ../../views/admin/admin_panel.php");

        } else {
            header("Location: ../../views/client/client_panel.php");

        }
    }

    $conex->close();
}
?>