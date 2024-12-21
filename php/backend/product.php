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
            echo "<table border='1'>";
            echo "<thead>";
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
                echo "<td>" . htmlspecialchars($fila["precio"]) . "€" ."</td>";
                echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
                echo "<td><img src='" . htmlspecialchars($fila["imagenes"]) . "' alt='" . htmlspecialchars($fila["nombre"]) . "' style='width: 100px; height: 100px; object-fit: contain;'></td>";
                echo "<td><button><a href = '../../views/auth/modify-product.php'>Modificar</a></button></td>";
                echo "<td><button><a href = '../../views/auth/delete-product.php'>Eliminar</a></button></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<button> <a href = '../../views/auth/register-product.php'>Agregar animal a la tabla</a></button>";
        } else {
            echo "No hay animales en la tienda";
        }
        
    }



    public function animalesCliente() {
        global $conex;
    
        $consulta = "SELECT * FROM animales";
        $resultado = $conex->query($consulta);
    
        if ($resultado->num_rows > 0) {
            echo "<form method='post' action=''>";
            echo "<table border='1'>";
            echo "<thead>";
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
                echo "<td>" . htmlspecialchars($fila["precio"]) . "€" ."</td>";
                echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
                echo "<td><img src='" . htmlspecialchars($fila["imagenes"]) . "' alt='" . htmlspecialchars($fila["nombre"]) . "' style='width: 100px; height: 100px; object-fit: contain;'></td>";
                echo "<td><input type='checkbox' name='productos[]' value='" . htmlspecialchars($fila["nombre"]) . "|" . htmlspecialchars($fila["precio"]) . "'></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<input type='submit' name='submit' value='Añadir a la cesta'>";
            echo "</form>";
    
            if (isset($_POST['submit'])) {
                $this->cesta();
            }
            
        } else {
            echo "No hay animales en la tienda";
        }
    }

    public function cesta() {
        if (isset($_POST['productos'])) {
            if (!isset($_SESSION['cesta'])) {
                $_SESSION['cesta'] = [];
            }
    
            foreach ($_POST['productos'] as $producto) {
                list($nombre, $precio) = explode('|', $producto);
                $cantidad = isset($_POST['cantidades'][$nombre]) ? (int)$_POST['cantidades'][$nombre] : 1;
                $_SESSION['cesta'][] = ['nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad];
            }
    
            $total = 0;
            echo "<h2>Cesta</h2>";
            echo "<ul>";
            foreach ($_SESSION['cesta'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                echo "<li>" . htmlspecialchars($item['nombre']) . " - " . htmlspecialchars($item['precio']) . "€ x " . htmlspecialchars($item['cantidad']) . " = " . htmlspecialchars($subtotal) . "€</li>";
                $total += $subtotal;
            }
            echo "</ul>";
            echo "<h3>Total: " . htmlspecialchars($total) . "€</h3>";
        } else {
            echo "<h2>Cesta</h2>";
            echo "<p>No hay productos en la cesta</p>";
        }
    }
}

?>
