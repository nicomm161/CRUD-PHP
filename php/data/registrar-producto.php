<?php

include("../../db/db.php");
include("../backend/product.php");

$control = true;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $producto = new Productos($nombre, $precio, $cantidad);

    if (empty($nombre) || empty($precio) || empty($cantidad)) {
        echo "Los campos no pueden estar vacios <br>";
        $control = false;
    }

    if ($control) {
        $producto->registrarProducto($nombre, $precio, $cantidad);
    }
}




?>