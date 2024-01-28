<?php

session_start();
require_once('../functions/functions.php');
require_once('./functions_bbdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = recoge('change-name');
    $lastname = recoge('change-lastname');

    if ($name == null && $lastname == null) {
        header("Location: ../profile.php");
        exit();
    } elseif ($lastname == null) {
        $pdo = conectadb();
        $consulta = "UPDATE usuarios
            SET nombre = :nombre
            WHERE id = :id;";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute([
            ":nombre" => $name,
            ":id" => $_SESSION['userLogin']['id']
        ])) {
            $_SESSION['userChangePass'] = 'Nombre cambiado correctamente';
            $_SESSION['userLogin']['nombre'] = $name;
        }
    } elseif ($name == null) {
        $pdo = conectadb();
        $consulta = "UPDATE usuarios
            SET apellidos = :apellidos
            WHERE id = :id;";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute([
            ":apellidos" => $lastname,
            ":id" => $_SESSION['userLogin']['id']
        ])) {
            $_SESSION['userChangePass'] = 'Apellido cambiado correctamente';
            $_SESSION['userLogin']['apellidos'] = $lastname;

        }
    } else {
        $pdo = conectadb();
        $consulta = "UPDATE usuarios
            SET nombre = :nombre, apellidos = :apellidos
            WHERE id = :id;";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute([
            ":nombre" => $name,
            ":apellidos" => $lastname,
            ":id" => $_SESSION['userLogin']['id']
        ])) {
            $_SESSION['userChangePass'] = 'Nombre y apellido actualizados';
            $_SESSION['userLogin']['nombre'] = $name;
            $_SESSION['userLogin']['apellidos'] = $lastname;
        }
    }
    header("Location: ../profile.php");
    exit();
}
