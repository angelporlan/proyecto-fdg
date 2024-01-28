<?php
session_start();
require_once('../functions/functions.php');
require_once('./functions_bbdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['avatar-delete'])) {
        $filenameToDelete = $_SESSION['userLogin']['ruta_imagen'];

        // Verificar si la imagen actual es "default.png"
        if ($filenameToDelete !== 'default.png') {
            $filePath = '../bbdd/' . $filenameToDelete;

            // Verificar si el archivo existe antes de intentar eliminarlo
            if (file_exists($filePath)) {
                // Intentar eliminar el archivo
                if (unlink($filePath)) {
                    $_SESSION['userLogin']['ruta_imagen'] = 'default.png';
                    $_SESSION['userDeleteImg'] = 'Avatar eliminado con exito!';

                    $pdo = conectadb();
                    $consulta ="UPDATE usuarios
                                SET ruta_imagen = 'default.png'
                                WHERE id = :id;";
                    
                    $resultado = $pdo->prepare($consulta);
                    if (!$resultado) {
                        // print "    <p>Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                    } elseif (!$resultado->execute([
                        ":id" => $_SESSION['userLogin']['id']
                    ])) {
                        // print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                    } else {
                        // $_SESSION['userSing'] = 'Registro creado correctamente';
                    }
                }
            }
        }

    }
    if (isset($_POST['avatar']) && isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Se hizo clic en "Reemplazar" y se seleccionó una nueva imagen
    
        // Obtener el ID del usuario
        $userId = $_SESSION['userLogin']['id'];
    
        // Obtener la extensión original del archivo
        $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    
        // Generar un nuevo nombre para la imagen con el formato 'img[id]_nombreoriginal.ext'
        $newAvatarName = 'img' . $userId . '_' . $_FILES['img']['name'];
    
        // Directorio donde se almacenan las imágenes
        $uploadDir = '../bbdd/';
    
        // Ruta completa al archivo de destino
        $targetPath = $uploadDir . $newAvatarName;
    
        // Ruta completa al archivo de la imagen existente
        $existingImagePath = $uploadDir . $_SESSION['userLogin']['ruta_imagen'];
        
        // Verificar si la imagen existente existe y eliminarla
        if (file_exists($existingImagePath) && $existingImagePath != '../bbdd/default.png') {
            unlink($existingImagePath);
        }

        // Mover la nueva imagen al directorio de destino
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
            $_SESSION['userLogin']['ruta_imagen'] = $newAvatarName;
    
            // Actualizar la base de datos con la nueva ruta de la imagen
            $pdo = conectadb();
            $consulta = "UPDATE usuarios
                        SET ruta_imagen = :ruta_imagen
                        WHERE id = :id;";
    
            $resultado = $pdo->prepare($consulta);
            if ($resultado->execute([
                ":ruta_imagen" => $newAvatarName,
                ":id" => $userId
            ])) {
                $_SESSION['userDeleteImg'] = 'Imagen actualizada';
            }
    
            
        }
    }
    

    header("Location: ../profile.php");
    exit();
}
?>
