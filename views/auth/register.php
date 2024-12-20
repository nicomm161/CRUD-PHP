<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Registrar Usuario</title>
</head>
<body>
    <form action="../../php/data/registrar-user.php" method="post">
        <fieldset>
            <legend>Registrar Usuario</legend>
            <input type="text" name="nombre" placeholder="Nombre"> <br>
            <input type="text" name="apellido" placeholder= "Apellido"> <br>
            <input type="text" name="user" placeholder="User"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="number" name="dinero" placeholder="Dinero"><br>
            <input type="submit" value="Registrar">
        </fieldset>
    </form>

    <p><a href="../client/client_panel.php">Volver a la zona cliente</a></p>

</body>
</html>