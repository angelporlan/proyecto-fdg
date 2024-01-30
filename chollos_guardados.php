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
            require_once "./functions/functions.php";

            $pdo = conectadb();
            $seccion = null;

            $consulta = "SELECT * FROM usuarios WHERE id = " . $_SESSION['userLogin']['id'];
            $resultado = $pdo->query($consulta);
            $datosUsuario = $resultado->fetch(PDO::FETCH_ASSOC);

            if ($datosUsuario['chollos_guardados'] == null || $datosUsuario['chollos_guardados'] == '[]') {
                echo "nada q mostar";
            } else {
                // Decodificar la cadena JSON
                $chollosGuardados = json_decode($datosUsuario['chollos_guardados'], true);

                // Crear una lista de IDs de chollos guardados para la consulta
                $chollosGuardadosIds = implode(",", $chollosGuardados);

                $seccion = null;
                if (isset($_GET['seccion'])) {
                    $seccion = $_GET['seccion'];
                }

                // Consultar la información de los chollos guardados
                $consultaChollos = "SELECT * FROM productos WHERE id IN ($chollosGuardadosIds)";

                if ($seccion !== null) {
                    $consultaChollos .= " AND seccion = '$seccion'";
                }

                $resultado = $pdo->query($consultaChollos);

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
                        echo "<p class='price-new'>$registro[precio_oferta] €</p>";
                        echo "<p class='price-old'>$registro[precio] €</p>";
                        $porcentajeDescuento = (($registro['precio'] - $registro['precio_oferta']) / $registro['precio']) * 100;
                        $porcentajeDescuento = '(' . round($porcentajeDescuento, 0) . '%)';
                        echo "<p class='discont'>$porcentajeDescuento</p>";
                        echo "<p class='category'>$registro[seccion]</p>";
                        echo "</div>";
                        $descripcionCorta = (strlen($registro['descripcion']) > 200) ? substr($registro['descripcion'], 0, 200) . '...' : $registro['descripcion'];
                        echo "<p class='description'>$descripcionCorta</p>";
                        echo "<div class='buttons'>";
                        echo "<div class='user'>";
    
                        $consulta2 = "SELECT nombre, apellidos, ruta_imagen FROM usuarios WHERE id = {$registro['id_user']}";
                        $resultado = $pdo->query($consulta2);
                        $datosUsuario = $resultado->fetch(PDO::FETCH_ASSOC);
                        $nombre = $datosUsuario['nombre'];
                        $apellidos = $datosUsuario['apellidos'];
    
                        $nombre_user = 'Usuario ' . $registro['id_user'];
                        if ($apellidos != null && $nombre == null) {
                            $nombre_user = $apellidos;
                        }
                        if ($nombre != null && $apellidos == null) {
                            $nombre_user = $nombre;
                        }
                        if ($apellidos != null && $nombre != null) {
                            $nombre_user = $nombre . ' ' . $apellidos;
                        }
    
                        $tiempo = tiempoTranscurrido($registro['fecha']);
    
                        echo "<img src='./bbdd/{$datosUsuario['ruta_imagen']}'>";                  
                        echo "<p>$nombre_user</p>";
                        echo "</div>";
                        echo "<div class='chollo-butons'>";
                        echo "<form action='./controler/process_guardar_chollo2.php' method='post'>";
                        echo "<input type='hidden' name='chollo_id' value='{$registro['id']}' />";
                        echo "<button type='submit' class='guardar-chollo'>&#128229;</button>";
                        echo "</form>";
                        echo "<button class='ir-al-chollo'>Ir al chollo</button>";
                        echo "</div>";
                        echo "<p class='fecha-producto'>$tiempo</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</article>";
                    }
                }
            }
            
                    
            
        ?>

            
        </div>

        <div class="container-right">
            <div class="shops-images">
                <strong class="tittle-shop-image">Tiendas populares</strong>
                <div class="shops">
                <a href="https://www.amazon.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/173_2/re/94x94/qt/70/173_2.jpg" alt="Tienda 1"></a>
                <a href="https://www.mediamarkt.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/171_4/re/94x94/qt/70/171_4.jpg" alt="Tienda 2"></a>
                <a href="https://www.elcorteingles.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/170_1/re/94x94/qt/70/170_1.jpg" alt="Tienda 3"></a>
                <a href="https://www.ebay.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/166_2/re/94x94/qt/70/166_2.jpg" alt="Tienda 4"></a>
                <a href="https://www.huawei.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/4198_2/re/94x94/qt/70/4198_2.jpg" alt="Tienda 5"></a>
                <a href="https://www.samsung.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/256_1/re/94x94/qt/70/256_1.jpg" alt="Tienda 6"></a>
                <a href="https://www.justeat.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/337_6/re/94x94/qt/70/337_6.jpg" alt="Tienda 7"></a>
                <a href="https://www.pccomponentes.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/202_2/re/94x94/qt/70/202_2.jpg" alt="Tienda 8"></a>
                <a href="https://www.adidas.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/178_7/re/94x94/qt/70/178_7.jpg" alt="Tienda 9"></a>
                <a href="https://www.reebok.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/179_6/re/94x94/qt/70/179_6.jpg" alt="Tienda 10"></a>
                <a href="https://www.nike.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/177_8/re/94x94/qt/70/177_8.jpg" alt="Tienda 11"></a>
                <a href="https://www.carrefour.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/211_4/re/94x94/qt/70/211_4.jpg" alt="Tienda 12"></a>
                <a href="https://www.banggood.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/160_2/re/94x94/qt/70/160_2.jpg" alt="Tienda 13"></a>
                <a href="https://www.myprotein.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/203_4/re/94x94/qt/70/203_4.jpg" alt="Tienda 14"></a>
                <a href="https://www.miravia.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/7530_1/re/94x94/qt/70/7530_1.jpg" alt="Tienda 15"></a>
                <a href="https://www.telepizza.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/198_3/re/94x94/qt/70/198_3.jpg" alt="Tienda 16"></a>
                <a href="https://www.ubereats.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/2160_3/re/94x94/qt/70/2160_3.jpg" alt="Tienda 17"></a>
                <a href="https://www.steam.es/" target="_blank"><img src="https://static.chollometro.com/merchants/raw/avatar/189_4/re/94x94/qt/70/189_4.jpg" alt="Tienda 18"></a>
                    <!-- <img src="https://static.chollometro.com/merchants/raw/avatar/165_2/re/94x94/qt/70/165_2.jpg">
                    <img src="https://static.chollometro.com/merchants/raw/avatar/205_4/re/94x94/qt/70/205_4.jpg"> -->
                </div>
            </div>
        </div>
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>