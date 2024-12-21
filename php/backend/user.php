<?php
include ("../../db/db.php");

class Usuario {
    protected $nombre;
    protected $apellido;
    protected $dinero;

    function __construct($nombre, $apellido, $dinero) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dinero = $dinero;
    }
}

class Admin extends Usuario {
    public $user;
    private $password;

    function __construct($user, $password, $nombre, $apellido, $dinero) {
        parent::__construct($nombre, $apellido, $dinero);
        $this->user = $user;
        $this->password = $password;
    }

    function privilegiosUser($user) {
        global $conex;
        $privilegio = "admin";

        $privilegios_user = "UPDATE usuarios SET privilegios = '$privilegio' WHERE user = '$user'";

        try {
            if ($conex->query($privilegios_user) === TRUE) {
                echo "Subiste a admin a " . htmlspecialchars($user) . "! <br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
            } else {
                echo "Error al actualizar privilegios: " . $conex->error . "<br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
        }
    }

    function quitarPrivilegios($user) {
        global $conex;
        $privilegio = "user";

        $quitar_privilegios = "UPDATE usuarios SET privilegios = '$privilegio' WHERE user = '$user'";
        try {
            if ($conex->query($quitar_privilegios) === TRUE) {
                echo "Privilegios degradados a " . htmlspecialchars($user) . "! <br>";
            } else {
                echo "Error al quitar privilegios: " . $conex->error . "<br>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function bloquearUser($user) {
        global $conex;
        $estado = "bloqueado";

        $bloquear_user = "UPDATE usuarios SET estado = '$estado' WHERE user = '$user'";

        try {
            if ($conex->query($bloquear_user) === TRUE) {
                echo "Bloqueo exitoso a " . htmlspecialchars($user) . "! <br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
            } else {
                echo "Error al bloquear usuario: " . $conex->error . "<br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
        }
    }

    function desbloquearUser($user) {
        global $conex;
        $estado = "activo";

        $desbloquear = "UPDATE usuarios SET estado = '$estado' WHERE user = '$user'";
        try {
            if ($conex->query($desbloquear) === TRUE) {
                echo "Desbloqueo exitoso a " . htmlspecialchars($user) . "! <br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
            } else {
                echo "Error al desbloquear usuario: " . $conex->error . "<br>";
                echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            echo "<button><a href='../../views/admin/admin_panel.php'>Volver</a></button>";
        }
    }

    public function devolverUsuarios() {
        global $conex;
    
        $usuarios = "SELECT * FROM usuarios";
    
        $consulta = $conex->query($usuarios);
        if ($consulta->num_rows > 0) {
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido</th>";
            echo "<th>Usuario</th>";
            echo "<th>Estado</th>";
            echo "<th>Privilegios</th>";
            echo "<th>Dinero</th>";
            echo "<th>Bloquear usuario</th>";
            echo "<th>Desbloquear usuario</th>";
            echo "<th>Agregar privilegios</th>";
            echo "<th>Degradar privilegios</th>";
            echo "</tr>";
            echo "</thead>";
            
            echo "<tbody>";
            while ($row = $consulta->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["apellido"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["user"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["estado"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["privilegios"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["dinero"]) . "€" . "</td>";
                echo "<td><a href='../../views/auth/block.php' class='btn btn-danger'>Bloquear</a></td>";
                echo "<td><a href='../../views/auth/unblock.php' class='btn btn-success'>Desbloquear</a></td>";
                echo "<td><a href='../../views/auth/modify_privileges.php' class='btn btn-primary'>Agregar</a></td>";
                echo "<td><a href='../../views/auth/downgrade-privileges.php' class='btn btn-warning'>Degradar</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
    
            echo "<button class='btn btn-primary mt-3'><a href='../../views/auth/shopAdmin.php' class='text-white' style='text-decoration: none;'>Gestionar tienda</a></button>";
        } else {
            echo "<div class='alert alert-info'>No hay usuarios</div>";
            echo "<button class='btn btn-secondary mt-3'><a href='../../views/admin/admin_panel.php' class='text-white' style='text-decoration: none;'>Volver</a></button>";
        }
    }
    


}

class Cliente extends Usuario{
    public $user;
    private $password;
    function __construct($user, $password, $nombre, $apellido, $dinero) {
        parent::__construct($nombre, $apellido, $dinero);
        $this->user = $user;
        $this->password = $password;
    }

    function modificarUser($user, $password) {
        global $conex;
        
        $hashedPassword = hash("sha256", $password);

        $actualizar_registro_user = "UPDATE usuarios SET password = '$hashedPassword' WHERE user = '$user'";

        try {
            if ($conex->query($actualizar_registro_user) === TRUE) {
                echo "Contraseña cambiada con exito " . htmlspecialchars($user) . "!" . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            } else {
                echo "Error al modificar usuario: " . $conex->error . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
        }
    }

    public function registrarUser($nombre, $apellido, $user, $password, $dinero) {
        global $conex;
    
        $hashedPassword = hash("sha256", $password);
        
        $insertar_registro_user = "INSERT INTO usuarios(nombre, apellido, user, password, dinero) VALUES ('$nombre','$apellido','$user','$hashedPassword','$dinero')";
    
        try {
            if ($conex->query($insertar_registro_user) === TRUE) {
                echo "Registro exitoso <br>";
                echo "¡Gracias por registrarse, " . htmlspecialchars($user) . "!" . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            } else {
                echo "Error al registrar usuario: <br>" . $conex->error . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
        }
    }

   public function loginUser($user, $password, $checkbox) {
        global $conex;
        $hashedPassword = hash("sha256", $password);
        $consulta = "SELECT * FROM usuarios WHERE user = '$user'";
        $resultado = $conex->query($consulta);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
    

            if ($hashedPassword === $usuario['password']) {

                session_start();
                $_SESSION['user'] = $user;
    

                if (!empty($checkbox)) {
                    setcookie('Usuario', $user, time() + (86400 * 30), "/"); 
                } else {
                    setcookie('Usuario', '', time() - 3600, "/"); 
                }
                echo "¡Gracias por iniciar sesión, " . htmlspecialchars($user) . "! <br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            } else {
                echo "Contraseña incorrecta, vuelve a intentarlo" . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
            }
        } else {
            echo "No se encontró el usuario, regístrate" . "<br>";
            echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
        }
    }

    public function valoracionWeb($user, $valoracion, $comentario) {
        global $conex;

       $valoracion_web = "INSERT INTO valoraciones(user, valoracion, comentario) VALUES ('$user','$valoracion','$comentario')";

        try {
            if ($conex->query($valoracion_web) === TRUE) {
                echo "Valoracion exitosa <br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            } else {
                echo "Tu usuario no existe: " . $conex->error . "<br>";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button> ";
        }
    }

    public function devolverValoraciones(){
        global $conex;
        $valoraciones = "SELECT * FROM valoraciones";
        $consulta = $conex->query($valoraciones);
        if ($consulta->num_rows > 0) {
            echo "<div class='container mt-5'>";
            echo "<h2 class='text-center mb-4'>Valoraciones de Usuarios</h2>";
            echo "<div class='row'>";
            while ($row = $consulta->fetch_assoc()) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Usuario: " . htmlspecialchars($row['user']) . "</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>Valoración: " . htmlspecialchars($row['valoracion']) . "</h6>";
                echo "<p class='card-text'>Comentario: " . htmlspecialchars($row['comentario']) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-info text-center mt-5'>No hay valoraciones</div>";
        }
    }
}    


?>
