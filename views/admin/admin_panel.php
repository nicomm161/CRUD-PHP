<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" type="image/png">
    <title>Administrador</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Panel de administrador</h1>
        <?php
        include("../../php/backend/user.php");
        include("../../php/backend/product.php");

        $admin = new Admin("","","","",0);
        $admin->devolverUsuarios();
        ?>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>