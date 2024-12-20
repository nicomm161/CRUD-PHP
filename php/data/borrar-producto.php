<?php

include("../../db/db.php");
include("../backend/product.php");

$control = true;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = 0;
    $cantidad = 0;

    $borrar_producto = new Productos($nombre, $precio, $cantidad);

    if (empty($nombre)) {
        echo "El nombre no puede estar vacio <br>";
        $control = false;
    }

    if ($control) {
        $borrar_producto->eliminarProducto($nombre);
    }
}

?>