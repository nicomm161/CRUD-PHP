<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Registrar producto</title>
</head>
<body>
    <form action="../../php/data/registrar-producto.php" method="post">
    <fieldset>
            <legend>Registrar Animal</legend>
            <input type="text" name="nombre" placeholder="Nombre"> <br>
            <input type="text" name="precio" placeholder= "Precio"> <br>
            <input type="text" name="cantidad" placeholder="Cantidad"><br>
            <input type="submit" value="Registrar">
        </fieldset>
    </form>



    <p><a href="../client/client_panel.php">Volver a la zona cliente</a></p>
    <p><a href="shop.php">Volver a la tienda</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>