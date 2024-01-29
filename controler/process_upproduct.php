<?php
session_start();
require_once('../functions/functions.php');
require_once('./functions_bbdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = recoge('nombre_articulo');
    $oferta = recoge('precio_oferta');
    $precio = recoge('precio_habitual');
    $seccion = recoge('seccion');    
    $descripcion = recoge('descripcion');
    $nuevoNombreImagen = '';
    // $nombre_user = 'Usuario ' . $_SESSION['userLogin']['id'];
    // if ($_SESSION['userLogin']['apellidos'] != null && $_SESSION['userLogin']['nombre'] == null) {
    //     $nombre_user = $_SESSION['userLogin']['apellidos'];
    // }
    // if ($_SESSION['userLogin']['nombre'] != null && $_SESSION['userLogin']['apellidos'] == null) {
    //     $nombre_user = $_SESSION['userLogin']['nombre'];
    // }
    // if ($_SESSION['userLogin']['apellidos'] != null && $_SESSION['userLogin']['nombre'] != null) {
    //     $nombre_user = $_SESSION['userLogin']['nombre'] . ' ' . $_SESSION['userLogin']['apellidos'];
    // }
    // $ruta_imagen_user = $_SESSION['userLogin']['ruta_imagen'];

    if ($nombre === null || $oferta === null || $precio === null || $seccion == 'nulo' || $descripcion == null) {
        $_SESSION['productError'] = '<p class="error">Todas las casillas deben estar rellenadas</p>';
        header("Location: ../singin.php");
        exit();
    }

    // Recoger información de la imagen
    $imagen = $_FILES['imagen'];

    // Verificar si se cargó correctamente
    if ($imagen['error'] === UPLOAD_ERR_OK) {
        // Ruta temporal del archivo en el servidor
        $rutaTemporal = $imagen['tmp_name'];

        // Nombre original del archivo
        $nombreOriginal = $imagen['name'];

        // Cambiar el nombre de la imagen
        $nuevoNombreImagen = 'product' . $_SESSION['userLogin']['id'] . '_' . $nombreOriginal;

        // Mover el archivo a un directorio permanente
        $rutaDestino = '../bbdd/' . $nuevoNombreImagen;
        move_uploaded_file($rutaTemporal, $rutaDestino);

        // Ahora puedes utilizar $nuevoNombreImagen en la base de datos u otras operaciones según tus necesidades
    } else {
        // Hubo un error al subir la imagen, asignar nombre predeterminado
        $nuevoNombreImagen = 'defaultproduct.png';
    }

    $pdo = conectadb();

    $consulta = "INSERT INTO productos (titulo, precio_oferta, precio, seccion, descripcion, ruta_imagen, fecha, id_user)
        VALUES (:nombre, :oferta, :precio, :seccion, :descripcion, :ruta_imagen, :fecha, :id_user)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p>Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([
        ":nombre" => $nombre,
        ":oferta" => $oferta,
        ":precio" => $precio,
        ":seccion" => $seccion,
        ":descripcion" => $descripcion,
        ":ruta_imagen" => $nuevoNombreImagen,
        ":fecha" => time(),
        ":id_user" => $_SESSION['userLogin']['id']
    ])) {
        print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        $_SESSION['userSing'] = 'Registro creado correctamente';
    }


    header("Location: ../index.php");
    exit();
}
?>
