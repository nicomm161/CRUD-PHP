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
                echo "Subiste a admin a este usuario";
            } else {
                echo "Error al actualizar privilegios: " . $conex->error;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function quitarPrivilegios($user) {
        global $conex;
        $privilegio = "cliente";

        $quitar_privilegios = "UPDATE usuarios SET privilegios = '$privilegio' WHERE user = '$user'";
        try {
            if ($conex->query($quitar_privilegios) === TRUE) {
                echo "Privilegios eliminados";
            } else {
                echo "Error al quitar privilegios: " . $conex->error;
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
                echo "Bloqueo exitoso";
            } else {
                echo "Error al bloquear usuario: " . $conex->error;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function desbloquearUser($user) {
        global $conex;
        $estado = "activo";

        $desbloquear = "UPDATE usuarios SET estado = '$estado' WHERE user = '$user'";
        try {
            if ($conex->query($desbloquear) === TRUE) {
                echo "Desbloqueo exitoso";
            } else {
                echo "Error al desbloquear usuario: " . $conex->error;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function devolverUsuarios() {
        global $conex;
        $usuarios = "SELECT * FROM usuarios";
        $consulta = $conex->query($usuarios);
        if ($consulta->num_rows > 0) {
            while ($row = $consulta->fetch_assoc()) {
                echo "Nombre: " . $row['nombre'] . "<br>";
                echo "Apellido: " . $row['apellido'] . "<br>";
                echo "Usuario: " . $row['user'] . "<br>";
                echo "Dinero: " . $row['dinero'] . "<br>";
                echo "Privilegios: " . $row['privilegios'] . "<br>";
                echo "Estado: " . $row['estado'] . "<br>";
                echo "<br>";
            }
        } else {
            echo "No hay usuarios";
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
                echo "Error al modificar usuario: " . $conex->error;
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
                echo "Error al registrar usuario: <br>" . $conex->error;
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
                echo "Contraseña incorrecta, vuelve a intentarlo";
                echo "<button><a href='../../views/client/client_panel.php'>Volver</a></button>";
            }
        } else {
            echo "No se encontró el usuario, regístrate";
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
                echo "Tu usuario no existe: <br>" . $conex->error;
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
            while ($row = $consulta->fetch_assoc()) {
                echo "Usuario: " . $row['user'] . "<br>";
                echo "Valoracion: " . $row['valoracion'] . "<br>";
                echo "Comentario: " . $row['comentario'] . "<br>";
                echo "<br>";
            }
        } else {
            echo "No hay valoraciones";
        }
    }
}


?>
