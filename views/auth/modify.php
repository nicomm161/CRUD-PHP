<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Modificar Usuario</title>
</head>
<body>

    <form action="../../php/data/modificar-user.php" method="post">
        <fieldset>
            <legend>Modificar Usuario</legend>
            <input type="text" name="user" placeholder="User"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Modificar">
        </fieldset>
    </form>

    <p><a href="../client/client_panel.php">Volver a la zona cliente</a></p>

</body>
</html>