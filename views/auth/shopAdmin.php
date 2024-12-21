<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Tienda</title>
</head>
<body>
    
    <h2>Gestión de animales en la tienda</h2>
    <?php
    include("../../php/backend/product.php");
    $producto = new Productos("", 0, 0);
    $producto->animalesAdmin();
    ?>

    <p><a href="../admin/admin_panel.php">Volver a la zona administrador</a></p>
    <p><a href="shop.php">Mirar tienda de cliente</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>