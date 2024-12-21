<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Degradar privilegios</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Degradar Privilegios</h1>
        <form action="../../php/data/degradar-privilegios.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="mb-3">Degradar Privilegios</legend>
                <div class="mb-3">
                    <input type="text" name="user" class="form-control" placeholder="User">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Degradar" class="btn btn-primary">
                </div>
            </fieldset>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="../admin/admin_panel.php" class="btn btn-secondary">Volver a la zona de administrador</a>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>