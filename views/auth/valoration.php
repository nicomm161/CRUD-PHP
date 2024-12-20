<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Valorar web</title>
</head>
<body>
    <form action="../../php/data/valoracion-web.php" method="post">
        <fieldset>
            <legend>Valorar la web</legend>
            <input type="text" name="user" placeholder="User"><br>
            <input type="number" name="valoracion" id="" placeholder = "1-5" value = "1"> <br>
            <textarea name="comentario" rows="5" cols="30" placeholder = "Comentario"></textarea><br>
            <input type="submit" value="Valorar">
        </fieldset>
    </form>

    <p><a href="../client/client_panel.php">Volver a la zona cliente</a></p>

</body>
</html>