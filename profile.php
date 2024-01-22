<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>
        
        <div class="container">
        <div class="avatar">
            <div class="left-zone"></div>
            <header>Tu avatar</header>
            <div class="right-zone"></div>
            <img src="./bbdd/default.png" class="img-from-profile">
            <form action="#">
                <button class="button-green" name= "avatar" value="">Reemplazar</button>
                <button class="button-red" name= "avatar" value="">Quitar</button>
            </form>
        </div>    

        <div class="info-user">
            <header>Datos personales</header>
            <?php
                if (isset($_SESSION['userLogin']['nombre'])) {
                    echo '<p><strong>Nombre: </strong>' . $_SESSION['userLogin']['nombre'] . '</p>';
                }
                if (isset($_SESSION['userLogin']['apellidos'])) {
                    echo '<p><strong>Apellidos: </strong>' . $_SESSION['userLogin']['apellidos'] . '</p>';
                }
                echo '<p><strong>Email: </strong>' . $_SESSION['userLogin']['email'] . '</p>';
            ?>
            <form action="#">
                <button class="button-red" name= "avatar" value="">Cambiar contraseña</button>
            </form>
        </div>
        </div>
    
        <form action="./controler/sing_off.php" method="post" name="close-sesion">
            <button class="button-red">Cerrar Sesión</button>
        </form>
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>