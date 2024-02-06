<header class="header-menu">
    <h1><a href="/proyecto-fdg/index.php">🔥CholloCentro</a></h1>
    <div class="left-zone-menu">
        <?php
            session_start();
            if (isset($_SESSION["userLogin"])) {
                $ruta_imagen = $_SESSION["userLogin"]['ruta_imagen'];
                echo "<a href='chollos_guardados.php' class='save_chollo'></a>";

                echo "<a href='profile.php' class='profile-menu' style='background: url(./bbdd/$ruta_imagen);    background-size: cover;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-right: 1rem;
                border: 2px solid rgb(0, 123, 255);'></a>";
            } else {
                echo "<a href='login.php' class='profile-menu'></a>";
            }
        ?>
        <a href="./share.php"><div class="share"><strong>+</strong>&nbspComparte</div></a>
    </div>
</header>


<?php
    if (isset($_SESSION['userSing'])) {
        echo "<p class='user-sing'>{$_SESSION['userSing']} - (Pulsar para eliminar mensaje)</p>";
        unset($_SESSION['userSing']);
    }
    if (isset($_SESSION['userLog'])) {
        echo "<p class='user-sing'>{$_SESSION['userLog']} - (Pulsar para eliminar mensaje)</p>";
        unset($_SESSION['userLog']);
    }
    if (isset($_SESSION['userDeleteImg'])) {
        echo "<p class='user-sing'>{$_SESSION['userDeleteImg']} - (Pulsar para eliminar mensaje)</p>";
        unset($_SESSION['userDeleteImg']);
    }   
    if (isset($_SESSION['userChangePass'])) {
        echo "<p class='user-sing'>{$_SESSION['userChangePass']} - (Pulsar para eliminar mensaje)</p>";
        unset($_SESSION['userChangePass']);
    }
    
    if (isset($_SESSION['userShare'])) {
        echo "<p class='user-sing user-share'>{$_SESSION['userShare']} - (Pulsar para eliminar mensaje)</p>";
        unset($_SESSION['userShare']);
    }
?>

<nav class="nav-menu">
    <ul>
        <li><a href="?seccion=electronica">Electrónica</a></li>
        <li><a href="?seccion=gaming">Gaming</a></li>
        <li><a href="?seccion=alimentacion">Alimentación</a></li>
        <li><a href="?seccion=moda">Moda y accesorios</a></li>
        <li><a href="?seccion=hogar">Hogar y vivienda</a></li>
        <li><a href="?seccion=otro">Otro</a></li>
    </ul>

</nav>