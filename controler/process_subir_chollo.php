<?php
    session_start();
    require_once('../functions/functions.php');
    require_once('./functions_bbdd.php');

    $id_chollo = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['userLogin'])) {
        $_SESSION['userShare'] = 'Debes iniciar sesión para publicar el comentario';
        header("Location: ../info_chollo.php?id=$id_chollo");
        exit();        
        }

        $comentario = recoge('comentario');
        $id_user = $_SESSION['userLogin']['id'];

        if ($comentario == null) {
            $_SESSION['userShare'] = 'Comentario vacio';
            header("Location: ../info_chollo.php?id=$id_chollo");
            exit(); 
        }

        $pdo = conectaDb();

        $consulta = "INSERT INTO comentarios (id_producto, id_usuario, comentario, fecha)
        VALUES (:id_producto, :id_usuario, :comentario, :fecha)";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            // print "    <p>Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([
            ":id_producto" => $id_chollo,
            ":id_usuario" => $id_user,
            ":comentario" => $comentario,
            ":fecha" => time()
        ])) {
            // print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            $_SESSION['userSing'] = 'Comentario publicado correctamente';
        }
        
        
        header("Location: ../info_chollo.php?id=$id_chollo");
        exit();

    }
    
    