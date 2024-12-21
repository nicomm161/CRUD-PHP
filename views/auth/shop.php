<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Tienda</title>
</head>
<body>
    <h1>Bienvenido a la tienda de animales</h1>
    <p><a href="../auth/register.php">Registrarte</a></p>
    <p><a href="../auth/login.php">Login</a></p>
    <p><a href="../auth/modify.php">Modificar tu usuario</a></p>
    
    
    <h2>Animales en la tienda</h2>
    <?php
    include("../../php/backend/product.php");
    $producto = new Productos("", 0, 0);
    $producto->animalesCliente();
    ?>



    <h2>Nuestras valoraciones</h2>
    <?php
    include("../../php/backend/user.php");
    $valoraciones = new Cliente("", "", "", "", 0); 
    $valoraciones->devolverValoraciones();
    
    ?>
    <p><a href="../auth/valoration.php">Añade tu valoracion web</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>