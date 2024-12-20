<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Modificar Privilegios</title>
</head>
<body>
    
    <form action="../../php/data/privilegios-user.php" method="post">
        <fieldset>
            <legend>Modificar Privilegios</legend>
            <input type="text" name="user" placeholder="User"><br>
            <input type="submit" value="Modificar">
        </fieldset>
    </form>

    <p><a href="../admin/admin_panel.php">Volver a la zona de administrador</a></p>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>