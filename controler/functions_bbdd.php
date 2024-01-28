<?php

require_once("config.php");


//Esta funcion me devuelve el PDO
function conectaDb()
{
    global $cfg;

    $dsn_conbbdd = "mysql:host=$cfg[mysqlHost];dbname=$cfg[mysqlDatabase];charset=utf8mb4";
    $dsn_sinbbdd = "mysql:host=$cfg[mysqlHost];charset=utf8mb4";
    $usuario = $cfg["mysqlUser"];
    $contraseña = $cfg["mysqlPassword"];

    try {
        //Conecto a una bbdd concreta
        $tmp = new PDO($dsn_conbbdd, $usuario, $contraseña);
    } catch (PDOException $e) {
        //Conecto pero sin escoger la bbdd. Por ejemplo, si voy a crearla
        $tmp = new PDO($dsn_sinbbdd, $usuario, $contraseña);
    } catch (PDOException $e) {
        print "    <p>Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        //return null;
        exit;
    } finally {
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return $tmp;
    }
}

//si el email esta en la bbdd, devuelve true
function isEmailLogin($email) {
    $pdo = conectaDb();
    $consulta = "SELECT email FROM usuarios";
    $resultado = $pdo->query($consulta);
    foreach ($resultado as $registro) {
        if (strtolower($registro['email']) == strtolower($email)) {
            return true;
        }
    }
    return false;
}

//si el email y la contraseña son correctos, le devuelvo el usuario
function retrieveUser($email, $password) {
    $pdo = conectaDb();
    $consulta = "SELECT * FROM usuarios WHERE email = :email";
    
    // Usar una consulta preparada para evitar inyecciones SQL
    $stmt = $pdo->prepare($consulta);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un usuario con el email proporcionado
    if ($usuario) {
        // Verificar si la contraseña proporcionada coincide con la contraseña almacenada
        if (password_verify($password, $usuario['contraseña'])) {
            return $usuario;
        }
    }

    return null;
}

