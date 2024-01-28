<?php
    session_start();
    require_once('../functions/functions.php');
    require_once('./functions_bbdd.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = recoge('new-password');

        if ($password == null) {
            header("Location: ../profile.php");
            exit();
        }

        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        $pdo = conectadb();
        $consulta = "UPDATE usuarios
            SET contraseña = :password
            WHERE id = :id;";

    
            $resultado = $pdo->prepare($consulta);
            if ($resultado->execute([
                ":password" => $newPassword,
                ":id" => $_SESSION['userLogin']['id']
            ])) {
                $_SESSION['userChangePass'] = 'Contraseña actualizada';

            }
    
            
        
        
        
        header("Location: ../profile.php");
        exit();

    }
    
    