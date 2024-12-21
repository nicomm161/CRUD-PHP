<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Registrar Usuario</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Registrar Usuario</h1>
        <form action="../../php/data/registrar-user.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="mb-3">Registrar Usuario</legend>
                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <input type="text" name="apellido" class="form-control" placeholder="Apellido">
                </div>
                <div class="mb-3">
                    <input type="text" name="user" class="form-control" placeholder="User">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="number" name="dinero" class="form-control" placeholder="Dinero">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Registrar" class="btn btn-primary">
                </div>
            </fieldset>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="../client/client_panel.php" class="btn btn-secondary me-2">Volver a la zona cliente</a>
            <a href="shop.php" class="btn btn-secondary">Volver a la tienda</a>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>