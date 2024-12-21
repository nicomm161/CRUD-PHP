<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Tienda</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenido a la tienda de animales</h1>
        <div class="d-flex justify-content-center mb-3">
            <a href="register.php" class="btn btn-primary me-2">Registrarte</a>
            <a href="login.php" class="btn btn-secondary me-2">Login</a>
            <a href="modify.php" class="btn btn-info me-2">Modificar tu usuario</a>
            <a href="../client/client_panel.php" class="btn btn-warning">Zona cliente</a>
        </div>
        
        <h2 class="text-center mb-4">Animales en la tienda</h2>
        <?php
        include("../../php/backend/product.php");
        $producto = new Productos("", 0, 0);
        $producto->animalesCliente();
        ?>

        <h2 class="text-center mt-5 mb-4">Nuestras valoraciones</h2>
        <?php
        include("../../php/backend/user.php");
        $valoraciones = new Cliente("", "", "", "", 0); 
        $valoraciones->devolverValoraciones();
        ?>
        <div class="d-flex justify-content-center mt-4">
            <a href="../auth/valoration.php" class="btn btn-success">Añade tu valoracion web</a>
        </div>
        
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>