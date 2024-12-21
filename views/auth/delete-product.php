<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Borrar producto</title>
</head>
<body>
    <form action="../../php/data/borrar-producto.php" method="post">
        <fieldset>
        <legend>Borrar animal</legend>
            <input type="text" name="nombre" placeholder="Nombre"> <br>
            <input type="submit" value="Eliminar">
        </fieldset>
    </form>

    <p><a href="../admin/admin_panel.php">Volver a la zona de administrador</a></p>
    <p><a href="shopAdmin.php">Ir a la tienda administrador</a></p>
    <p><a href="shop.php">Ir a la tienda cliente</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>