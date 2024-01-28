<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/change_password.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/profile.js"></script>
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>  

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if (isset($_POST['reemplazar'])) {
                ?>
                    <form action="./controler/process_editinfouser.php" method="post">
                    <header class="new-password-title">Editar datos</header>

                    <p><i class="fa-solid fa-user changepassicon"></i>Cambiar Nombre</p>
                    <input type="text" name="change-name" placeholder="Nuevo nombre">

                    <p><i class="fa-regular fa-user changepassicon"></i>Cambiar Apellido</p>
                    <input type="text" name="change-lastname" placeholder="Nuevo apellido">

                    <div class="infolitle">
                    <p>Dejar la casilla en blanco</p>
                    <p>no supondrá ningun cambio</p>
                    </div>
                    <button class="button-red" name= "avatar" value="">Editar datos</button>
                    </form>
                <?php
            } elseif (isset($_POST['cambiar_contraseña'])) {
                ?>
                    <form action="./controler/process_changepassword.php" method="post">
                    <header class="new-password-title">Cambiar contraseña</header>
                    <p><i class="fa-solid fa-lock changepassicon"></i>Nueva contraseña</p>
                    <input type="password" name="new-password">
                    <button class="button-red" name= "avatar" value="">Cambiar contraseña</button>
                    </form>
                <?php
            }
        }
    ?>




    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>