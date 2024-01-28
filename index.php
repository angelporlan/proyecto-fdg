<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/index.js"></script>
</head>
<body>
    <?php include_once('./components/menu.php')?>
    
    <main>

       
        <div class="container-left">
        <?php
            require_once "./controler/functions_bbdd.php";

            $pdo = conectadb();
            $consulta = "SELECT * FROM productos ORDER BY id DESC;";

            $resultado = $pdo->query($consulta);

            if ($resultado) {
                foreach ($resultado as $registro) {
                    echo "<article>";
                    echo "<div class='left-zone'>";
                    echo "<img src='./bbdd/$registro[ruta_imagen]'>";
                    echo "</div>";
                    echo "<div class='right-zone'>";
                    $tituloCorto = (strlen($registro['titulo']) > 60) ? substr($registro['titulo'], 0, 60) . '...' : $registro['titulo'];
                    echo "<strong>$tituloCorto</strong>";
                    echo "<div class='prices'>";
                    echo "<p class='price-new'>$registro[precio_oferta]</p>";
                    echo "<p class='price-old'>$registro[precio]</p>";
                    $porcentajeDescuento = (($registro['precio'] - $registro['precio_oferta']) / $registro['precio']) * 100;
                    $porcentajeDescuento = '(' . round($porcentajeDescuento, 0) . '%)';
                    echo "<p class='discont'>$porcentajeDescuento</p>";
                    echo "<p class='category'>$registro[seccion]</p>";
                    echo "</div>";
                    $descripcionCorta = (strlen($registro['descripcion']) > 200) ? substr($registro['descripcion'], 0, 200) . '...' : $registro['descripcion'];
                    echo "<p class='description'>$descripcionCorta</p>";
                    echo "<div class='buttons'>";
                    echo "<div class='user'>";
                    echo "<img src='./bbdd/$registro[ruta_imagen_user]'>";
                    echo "<p>$registro[nombre_user]</p>";
                    echo "</div>";
                    echo "<button class='ir-al-chollo'>Ir al chollo</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</article>";
                }
            }
        ?>

            
        </div>

        <div class="container-right">
            <div class="shops-images">
                <strong class="tittle-shop-image">Tiendas populares</strong>
                <div class="shops">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/173_2/re/94x94/qt/70/173_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/171_4/re/94x94/qt/70/171_4.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/170_1/re/94x94/qt/70/170_1.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/166_2/re/94x94/qt/70/166_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/4198_2/re/94x94/qt/70/4198_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/256_1/re/94x94/qt/70/256_1.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/337_6/re/94x94/qt/70/337_6.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/202_2/re/94x94/qt/70/202_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/178_7/re/94x94/qt/70/178_7.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/179_6/re/94x94/qt/70/179_6.jpg">       
                    <img src="https://static.chollometro.com/merchants/raw/avatar/177_8/re/94x94/qt/70/177_8.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/211_4/re/94x94/qt/70/211_4.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/160_2/re/94x94/qt/70/160_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/203_4/re/94x94/qt/70/203_4.jpg">             
                    <img src="https://static.chollometro.com/merchants/raw/avatar/7530_1/re/94x94/qt/70/7530_1.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/198_3/re/94x94/qt/70/198_3.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/2160_3/re/94x94/qt/70/2160_3.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/189_4/re/94x94/qt/70/189_4.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/165_2/re/94x94/qt/70/165_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/205_4/re/94x94/qt/70/205_4.jpg">
                </div>
            </div>
        </div>
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>