<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Tienda</title>
</head>
<body>
    <h1>Bienvenido a la tienda de animales</h1>

    <a href="buy.php">Carrito</a>
    <form action="../../php/data/comprar-producto.php" method="post">
        <fieldset>
            <legend>Comprar Producto</legend>
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="submit" value="Comprar">
        </fieldset>

        <p><a href="../client/client_panel.php"> Volver a la zona cliente</a></p>
    </form>
</body>
</html>