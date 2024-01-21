<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/singin.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>
        
        <form action="./controler/process_singin.php" method="post" enctype="multipart/form-data">
            <header>Crear cuenta</header>
            <?php
                if (isset($_SESSION['singError'])) {
                    echo $_SESSION['singError'];
                    unset($_SESSION['singError']);
                }
            ?>
                <div class="inputs">
                    <div class="name">
                        <div class="input-info">
                            <i class="fa-solid fa-user"></i>
                            <p>&nbspName</p>
                        </div>
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="lastname">
                        <div class="input-info">
                            <i class="fa-regular fa-user"></i>
                            <p>&nbspLastname</p>
                        </div>
                        <input type="text" name="lastname" placeholder="Lastname">
                    </div>
                    <div class="email">
                        <div class="input-info">
                            <i class="fa-solid fa-envelope"></i>
                            <p>&nbsp* Email</p>
                        </div>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="password">
                        <div class="input-info">
                            <i class="fa-solid fa-lock"></i>
                            <p>&nbsp* Password</p>
                        </div>
                        <input type="password" name="password" placeholder="Contraseña">
                    </div>
                    <input type="file" name="img" id="img">
                    <label for="img">Seleccionar archivo</label>

                    <div class="buttons">
                        <button>Crear cuenta</button>
                        <div class="log-in"><a href="./login.php" class="a-log-in">Iniciar sesión</a></div>
                    </div>
                </div>
        </form>
        
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>