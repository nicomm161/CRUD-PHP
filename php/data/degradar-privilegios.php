<?php

include("../../db/db.php");
include("../backend/user.php");

$control = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars(trim($_POST["user"]));

    if (empty($user)) {
        echo "El usuario no puede estar vacio <br>";
        $control = false;
    }

    if ($control) {
        $desbloquear_user = new Admin($user, "","","",0);
        $desbloquear_user->quitarPrivilegios($user);
    }
}


?>