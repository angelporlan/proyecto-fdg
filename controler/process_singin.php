<?php
session_start();
require_once('../functions/functions.php');
require_once('./functions_bbdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = recoge('name');
    $lastname = recoge('lastname');
    $email = recoge('email');
    $password = recoge('password');
    $definitiveFile = 'default.png';

    // Verificar si se subió un archivo
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        // Directorio donde se almacenarán las imágenes
        $uploadDir = '../bbdd/';
        // Nombre del archivo (puede ser mejor manejar la generación del nombre)
        $uploadFile = $uploadDir . basename($_FILES['img']['name']);
        $definitiveFile = basename($_FILES['img']['name']);

        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
            // Archivo movido correctamente
            $ruta_imagen = $uploadFile;
        } else {
            // Error al mover el archivo
            $_SESSION['singError'] = '<p class="error">Error al subir la foto</p>';
            header("Location: ../singin.php");
            exit();
        }
    } else {
        // No se subió ninguna foto
        $ruta_imagen = 'no_rute'; // Puedes establecer un valor predeterminado o mostrar un mensaje de error
    }

    if ($email == '' || $password == '') {
        $_SESSION['singError'] = '<p class="error">Las casillas con * son obligatorias</p>';
        header("Location: ../singin.php");
        exit();
    }

    if (!str_contains($email, '@') || !str_contains($email, '.')) {
        $_SESSION['singError'] = '<p class="error">Email inválido</p>';
        header("Location: ../singin.php");
        exit();
    }

    if (isEmailLogin($email)) {
        $_SESSION['singError'] = '<p class="error">Email ya registrado</p>';
        header("Location: ../singin.php");
        exit();
    }

    // Generar el hash de la contraseña
    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $pdo = conectadb();

    $consulta = "INSERT INTO usuarios (nombre, apellidos, email, contraseña, ruta_imagen)
        VALUES (:name, :lastname, :email, :password, :ruta_imagen)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p>Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([
        ":name" => $name,
        ":lastname" => $lastname,
        ":email" => $email,
        ":password" => $newPassword,
        ":ruta_imagen" => $definitiveFile
    ])) {
        print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        $_SESSION['userSing'] = 'Registro creado correctamente';
    }

    header("Location: ../login.php");
    exit();
}
?>
