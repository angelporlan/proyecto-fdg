<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/login.js"></script>
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>
        
        <form action="./controler/process_login.php" method="post">
            <header>Iniciar sesión</header>
            <?php
                if (isset($_SESSION['logError'])) {
                    echo $_SESSION['logError'];
                    unset($_SESSION['logError']);
                }
            ?>
                <div class="inputs">
                    <div class="email">
                        <div class="input-info">
                            <i class="fa-solid fa-envelope"></i>
                            <p>&nbspEmail</p>
                        </div>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="password">
                        <div class="input-info">
                            <i class="fa-solid fa-lock"></i>
                            <p>&nbspPassword</p>
                        </div>
                        <input type="password" name="password" placeholder="Contraseña">
                    </div>

                    <div class="buttons">
                        <button>Iniciar sesión</button>
                        <div class="sing-in"><a href="./singin.php" class="a-sing-in">Crear cuenta</a></div>
                    </div>
                </div>
        </form>
        
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>