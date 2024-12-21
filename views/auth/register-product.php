<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Registrar producto</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Registrar Animal</h1>
        <form action="../../php/data/registrar-producto.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="mb-3">Registrar Animal</legend>
                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <input type="text" name="precio" class="form-control" placeholder="Precio">
                </div>
                <div class="mb-3">
                    <input type="text" name="cantidad" class="form-control" placeholder="Cantidad">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Registrar" class="btn btn-primary">
                </div>
            </fieldset>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="../admin/admin_panel.php" class="btn btn-secondary me-2">Volver a la zona de administrador</a>
            <a href="shopAdmin.php" class="btn btn-secondary me-2">Ir a la tienda administrador</a>
            <a href="shop.php" class="btn btn-secondary">Ir a la tienda cliente</a>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>