<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Valorar web</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Valorar la web</h1>
        <form action="../../php/data/valoracion-web.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="mb-3">Valorar la web</legend>
                <div class="mb-3">
                    <input type="text" name="user" class="form-control" placeholder="User">
                </div>
                <div class="mb-3">
                    <input type="number" name="valoracion" class="form-control" placeholder="1-5" value="1" min="1" max="5">
                </div>
                <div class="mb-3">
                    <textarea name="comentario" class="form-control" rows="5" placeholder="Comentario"></textarea>
                </div>
                <div class="d-grid">
                    <input type="submit" value="Valorar" class="btn btn-primary">
                </div>
            </fieldset>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="shop.php" class="btn btn-secondary me-2">Volver a la tienda</a>
            <a href="../client/client_panel.php" class="btn btn-secondary">Volver a la zona cliente</a>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>