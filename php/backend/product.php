<?php

include("../../db/db.php");

class Productos {
    public $nombre;
    public $precio;
    public $cantidad;

    function __construct($nombre, $precio, $cantidad) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    function modificarProducto($nombre, $precio, $cantidad) {
        global $conex;
        

        $actualizar_animal = "UPDATE animales SET nombre = '$nombre', precio = '$precio', cantidad = '$cantidad' WHERE nombre = '$nombre'";

        try {
            if ($conex->query($actualizar_animal) === TRUE) {
                echo "Animal modificado con exito " . htmlspecialchars($nombre) . "!" . "<br>";
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button> ";
            } else {
                echo "Error al modificar usuario: " . $conex->error;
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button> ";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button>";
        }
    }
    public function registrarProducto($nombre, $precio, $cantidad) {
        global $conex;

        
        $insertar_producto = "INSERT INTO animales(nombre, precio, cantidad) VALUES ('$nombre','$precio','$cantidad')";
    
        try {
            if ($conex->query($insertar_producto) === TRUE) {
                echo "Animal añadido con éxito " . htmlspecialchars($nombre) . "<br>";
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button> ";
            } else {
                echo "Error al registrar usuario: <br>" . $conex->error;
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button>";
        }
    }

    public function eliminarProducto($nombre) {
        global $conex;

        $eliminar_animal = "DELETE FROM animales WHERE nombre = '$nombre'";

        try {
            if ($conex->query($eliminar_animal) === TRUE) {
                echo "Animal eliminado con exito " . htmlspecialchars($nombre) . "!" . "<br>";
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button> ";
            } else {
                echo "Error al eliminar animal: " . $conex->error;
                echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button> ";
            }    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/auth/shop.php'>Volver a la tienda</a></button>";
        }
}

public function animalesAdmin() {
    global $conex;

    $consulta = "SELECT * FROM animales";
    $resultado = $conex->query($consulta);

    if ($resultado->num_rows > 0) {
        echo "<table class='table table-striped table-bordered table-hover'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Precio</th>";
        echo "<th>Stock</th>";
        echo "<th>Imagen</th>";
        echo "<th>Modificar animal</th>";
        echo "<th>Eliminar animal</th>";
        echo "</tr>";
        echo "</thead>";
        
        echo "<tbody>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["precio"]) . "€" . "</td>";
            echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
            echo "<td><img src='" . htmlspecialchars($fila["imagenes"]) . "' alt='" . htmlspecialchars($fila["nombre"]) . "' class='img-fluid' style='width: 100px; height: 100px; object-fit: contain;'></td>";
            echo "<td><a href='../../views/auth/modify-product.html' class='btn btn-primary'>Modificar</a></td>";
            echo "<td><a href='../../views/auth/delete-product.html' class='btn btn-danger'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        
        echo "<button class='btn btn-success mt-3'><a href='../../views/auth/register-product.html' class='text-white' style='text-decoration: none;'>Agregar animal a la tabla</a></button>";
    } else {
        echo "<div class='alert alert-info'>No hay animales en la tienda</div>";
    }
}




public function animalesCliente() {
    global $conex;

    $consulta = "SELECT * FROM animales";
    $resultado = $conex->query($consulta);

    if ($resultado->num_rows > 0) {
        echo "<form method='post' action=''>";
        echo "<table class='table table-striped table-bordered table-hover'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Precio</th>";
        echo "<th>Stock</th>";
        echo "<th>Imagen</th>";
        echo "<th>Seleccionar</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["precio"]) . "€" . "</td>";
            echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
            echo "<td><img src='" . htmlspecialchars($fila["imagenes"]) . "' alt='" . htmlspecialchars($fila["nombre"]) . "' class='img-fluid' style='width: 100px; height: 100px; object-fit: contain;'></td>";
            echo "<td>";
            echo "<input type='checkbox' name='productos[]' value='" . htmlspecialchars($fila["nombre"]) . "|" . htmlspecialchars($fila["precio"]) . "'> Seleccionar";
            echo "<input type='number' name='cantidades[" . htmlspecialchars($fila["nombre"]) . "]' value='1' min='1' max='" . htmlspecialchars($fila["cantidad"]) . "' class='form-control mb-2'>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<div class='text-center mt-3'>";
        echo "<button type='submit' name='accion' value='agregar' class='btn btn-success'>Añadir seleccionados a la cesta</button>";
        echo "</div>";
        echo "</form>";

        if (isset($_POST['accion']) && $_POST['accion'] === 'agregar') {
            $this->agregarACesta();
        }
        
    } else {
        echo "<div class='alert alert-info'>No hay animales en la tienda</div>";
    }
}

public function agregarACesta() {
    if (isset($_POST['productos'])) {
        foreach ($_POST['productos'] as $producto) {
            $producto_info = explode("|", $producto);
            $nombre = $producto_info[0];
            $precio = (float)$producto_info[1];
            $cantidad = (int)$_POST['cantidades'][$nombre];

            if (!isset($_SESSION['cesta'])) {
                $_SESSION['cesta'] = [];
            }

            if (isset($_SESSION['cesta'][$nombre])) {
                $_SESSION['cesta'][$nombre]['cantidad'] += $cantidad;
            } else {
                $_SESSION['cesta'][$nombre] = [
                    'precio' => $precio,
                    'cantidad' => $cantidad
                ];
            }
        }
        echo "<div class='alert alert-success'>Productos añadidos a la cesta</div>";
    }
}

public function mostrarCesta() {
    if (!empty($_SESSION['cesta'])) {
        echo "<h3>Tu Cesta</h3>";
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Acción</th></tr>";
        $total = 0;
        foreach ($_SESSION['cesta'] as $nombre => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($nombre) . "</td>";
            echo "<td>" . number_format($producto['precio'], 2) . "€</td>";
            echo "<td>" . $producto['cantidad'] . "</td>";
            echo "<td>" . number_format($subtotal, 2) . "€</td>";
            echo "<td><form method='post'><button type='submit' name='eliminar' value='" . htmlspecialchars($nombre) . "'>Eliminar</button></form></td>";
            echo "</tr>";
        }
        echo "<tr><td colspan='3'><strong>Total</strong></td><td colspan='2'>" . number_format($total, 2) . "€</td></tr>";
        echo "</table>";

        if (isset($_POST['eliminar'])) {
            unset($_SESSION['cesta'][$_POST['eliminar']]);
            echo "<div class='alert alert-warning'>Producto eliminado de la cesta</div>";
        }
    } else {
        echo "<div>Tu cesta está vacía</div>";
    }
}

}



?>
