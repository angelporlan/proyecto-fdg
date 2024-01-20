<header class="header-menu">
    <h1><a href="/proyecto-fdg/index.php">🔥Chollocentro</a></h1>
    <div class="left-zone">
        <?php
            // session_start();
            if (isset($_SESSION["userLogin"])) {
                
            } else {
                echo "<a href='login.php' class='profile'></a>";
            }
        ?>
        <div class="share"><strong>+</strong>&nbspComparte</div>
    </div>
</header>

<nav class="nav-menu">
    <ul>
        <li><a href="#">Electrónica</a></li>
        <li><a href="#">Gaming</a></li>
        <li><a href="#">Alimentación</a></li>
        <li><a href="#">Moda y accesorios</a></li>
        <li><a href="#">Hogar y vivienda</a></li>
    </ul>

</nav>