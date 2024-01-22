<?php
    session_start();
    require_once('../functions/functions.php');
    require_once('./functions_bbdd.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = recoge('name');
        $lastname = recoge('lastname');
        $email = recoge('email');
        $password = recoge('password');
        //me falta la foto

        if ($email == '' || $password == '') {
            $_SESSION['singError'] = '<p class="error">Las casillas con * son obligatorias</p>';
            header("Location: ../singin.php");
            exit();
        }

        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            $_SESSION['singError'] = '<p class="error">Email invalido</p>';
            header("Location: ../singin.php");
            exit();
        }

        if (isEmailLogin($email)) {
            $_SESSION['singError'] = '<p class="error">Email ya registrado</p>';
            header("Location: ../singin.php");
            exit();
        }

        
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
            ":password" => $password,
            ":ruta_imagen" => 'no_rute' // valor de ruta cambiar
        ])) {
            print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            $_SESSION['userSing'] = 'Registro creado correctamente';
        }
        
        header("Location: ../login.php");
        exit();

    }
    
    