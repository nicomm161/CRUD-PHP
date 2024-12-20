<?php

include("../../db/db.php");
include("../backend/product.php");

$control = true;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $producto_modificar = new Productos($nombre, $precio, $cantidad);

    if (empty($nombre)) {
        echo "El nombre no puede estar vacio <br>";
        $control = false;
    }

    if (empty($precio)) {
        echo "El precio no puede estar vacio <br>";
        $control = false;
    }

    if (empty($cantidad)) {
        echo "La cantidad no puede estar vacia <br>";
        $control = false;
    }

    if ($control) {
        $producto_modificar->modificarProducto($nombre, $precio, $cantidad);
    }
}




?>