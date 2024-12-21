<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <title>Administrador</title>
</head>
<body>
    <h1>Panel de administrador</h1>
    <?php
    
    include("../../php/backend/user.php");
    include("../../php/backend/product.php");

    $admin = new Admin("","","","",0);

    $admin->devolverUsuarios();


    
    
    
    ?>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>