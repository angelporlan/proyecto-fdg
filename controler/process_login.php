<?php
    session_start();
    require_once('../functions/functions.php');
    require_once('./functions_bbdd.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = recoge('email');
        $password = recoge('password');

        if ($email == '' || $password == '') {
            $_SESSION['logError'] = '<p class="error">Las casillas con * son obligatorias</p>';
            header("Location: ../login.php");
            exit();
        }

        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            $_SESSION['logError'] = '<p class="error">Email invalido</p>';
            header("Location: ../login.php");
            exit();
        }

        if ($user = retrieveUser($email, $password)) {
            $_SESSION['userLogin'] = $user;
            $_SESSION['userLog'] = 'Has iniciado sesión';
        } else {
            // El usuario no fue encontrado o la contraseña no coincide
            $_SESSION['logError'] = '<p class="error">Credenciales incorrectas</p>';
            header("Location: ../login.php");
            exit();
        }
        
        
        header("Location: ../index.php");
        exit();

    }
    
    