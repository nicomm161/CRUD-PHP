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

    <p><a href="../client/client_panel.php">Volver a la zona cliente</a></p>
    <p><a href="shop.php">Volver a la tienda</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>