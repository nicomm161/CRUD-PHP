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
                echo "Animal añadido con éxito" . htmlspecialchars($nombre) . "<br>";
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

    public function devolverProductos() {
        global $conex;

        $consulta = "SELECT * FROM animales";
        $resultado = $conex->query($consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "Nombre: " . $fila["nombre"] . " Precio: " . $fila["precio"] . " Cantidad: " . $fila["cantidad"] . "<br>";
            }
        } else {
            echo "No hay animales en la tienda";
        }
    }

}

?>
