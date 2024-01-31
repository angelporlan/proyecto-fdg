<?php
    require_once "./controler/functions_bbdd.php";
    require_once "./functions/functions.php";
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $id_product = $_GET['id'];
        } else {
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }

    $pdo = conectaDb();
    $consulta = "SELECT * FROM productos WHERE id IN ($id_product)";
    $resultado = $pdo->query($consulta);
    $datosProducto = $resultado->fetch(PDO::FETCH_ASSOC);

    $consulta2 = "SELECT nombre, apellidos, ruta_imagen FROM usuarios WHERE id = {$datosProducto['id_user']}";
    $resultado2 = $pdo->query($consulta2);
    $datosUsuario = $resultado2->fetch(PDO::FETCH_ASSOC);
    $nombre = $datosUsuario['nombre'];
    $apellidos = $datosUsuario['apellidos'];
    $nombre_user = 'Usuario ' . $datosProducto['id_user'];
    if ($apellidos != null && $nombre == null) {
        $nombre_user = $apellidos;
    }
    if ($nombre != null && $apellidos == null) {
        $nombre_user = $nombre;
    }
    if ($apellidos != null && $nombre != null) {
        $nombre_user = $nombre . ' ' . $apellidos;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/info_chollo.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/index.js"></script>
</head>
<body>
    <?php include_once('./components/menu.php')?>
    
    <main>
        
    <div class="product-container">
        <div class="left-zone">
            <img src="./bbdd/<?php echo $datosProducto['ruta_imagen'] ?>">
        </div>
        <div class="right-zone">
            <header class="title-product">
                <strong><?php echo $datosProducto['titulo'] ?></strong>
            </header>
            <div class="precios">
                <p><b><?php echo $datosProducto['precio_oferta'] ?>€ </b><?php echo $datosProducto['precio'] ?>€</p>
            </div>
            <div class="button-info-user">
                <div class="info-user">
                    <img src="./bbdd/<?php echo $datosUsuario['ruta_imagen']?>">
                    <p><?php echo $nombre_user?></p>
                </div>
                <button class="ir-al-chollo">Ir al chollo</button>
            </div>
            <p class="descripcion"><?php echo $datosProducto['descripcion']?></p>
        </div>
    </div>
        
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>