<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <!-- <link rel="stylesheet" href="./css/login.css"> -->
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>
        
        <?php
        echo "" . $_SESSION['userLogin']['email'];
        ?>
        
        <form action="./controler/sing_off.php" method="post">
            <button>Cerrar Sesión</button>
        </form>
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>