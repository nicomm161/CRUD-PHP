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
        echo "<th>Comprar</th>";
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
            echo "<input type='number' name='cantidades[" . htmlspecialchars($fila["nombre"]) . "]' value='1' min='1' max='" . htmlspecialchars($fila["cantidad"]) . "' class='form-control mb-2'>";
            echo "<button type='submit' name='producto' value='" . htmlspecialchars($fila["nombre"]) . "|" . htmlspecialchars($fila["precio"]) . "' class='btn btn-primary'>Comprar</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</form>";

        if (isset($_POST['producto'])) {
            $this->cesta();
        }
        
    } else {
        echo "<div class='alert alert-info'>No hay animales en la tienda</div>";
    }
}

public function cesta() {
    if (isset($_POST['producto'])) {
        list($nombre, $precio) = explode('|', $_POST['producto']);
        $cantidad = isset($_POST['cantidades'][$nombre]) ? (int)$_POST['cantidades'][$nombre] : 1;

        if (!isset($_SESSION['cesta'])) {
            $_SESSION['cesta'] = [];
        }

        $found = false;
        foreach ($_SESSION['cesta'] as &$item) {
            if ($item['nombre'] == $nombre) {
                $item['cantidad'] += $cantidad;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cesta'][] = ['nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad];
        }

        $total = 0;
        echo "<h2>Cesta</h2>";
        echo "<ul class='list-group'>";
        foreach ($_SESSION['cesta'] as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo htmlspecialchars($item['nombre']) . " - " . htmlspecialchars($item['precio']) . "€ x " . htmlspecialchars($item['cantidad']) . " = " . htmlspecialchars($subtotal) . "€";
            echo "</li>";
            $total += $subtotal;
        }
        echo "</ul>";
        echo "<h3 class='mt-3'>Total: " . htmlspecialchars($total) . "€</h3>";
    } else {
        echo "<h2>Cesta</h2>";
        echo "<p>No hay productos en la cesta</p>";
    }
}

}

?>
