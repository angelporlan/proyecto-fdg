<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/cb93a00799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/share.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include_once('./components/menu.php')?>

    <main>
        
    <?php if (!isset($_SESSION['userLogin'])) { $_SESSION['userShare'] = 'Debes estar registrado para compartir un chollo'; header("Location: ./index.php"); exit();} else { ?> 
        
    <form action="./controler/process_upproduct.php" method="post" enctype="multipart/form-data">
        <header class="new-product-title">Publicar chollo</header>

        <p>Nombre del artículo</p>
        <input type="text" name="nombre_articulo">

        <div class="prices-section">
            <div>
                <p>Precio oferta</p>
                <input type="number" name="precio_oferta" step="0.01">
            </div>

            <div>
                <p>Precio habitual</p>
                <input type="number" name="precio_habitual" step="0.01">
            </div>

            <div>
                <p>Sección</p>
                <select name="seccion">
                    <option value="nulo" selected>Seleccione sección</option>
                    <option value="electronica">Electrónica</option>
                    <option value="gaming">Gaming</option>
                    <option value="alimentacion">Alimentación</option>
                    <option value="moda">Moda</option>
                    <option value="hogar">Hogar</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>

        <p>Descripción</p>
        <textarea name="descripcion"></textarea>
        
        <input type="file" name="imagen">

        <button type="submit">Enviar</button>
    </form>
        
    <?php } ?>    
    </main>

    <?php include_once('./components/footer.php')?>
</body>
</html>
