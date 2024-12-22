<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" type="image/png">
    <title>Tienda</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Gestión de animales en la tienda</h2>
        <?php
        include("../../php/backend/product.php");
        $producto = new Productos("", 0, 0);
        $producto->animalesAdmin();
        ?>
        <div class="d-flex justify-content-center mt-4">
            <a href="../admin/admin_panel.php" class="btn btn-secondary me-2">Volver a la zona administrador</a>
            <a href="shop.php" class="btn btn-secondary">Mirar tienda de cliente</a>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>