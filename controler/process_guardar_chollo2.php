<?php
    session_start();
    require_once('../functions/functions.php');
    require_once('./functions_bbdd.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['userLogin'])) {
            header("Location: ../index.php");
            exit();
        }

        // Obtener y convertir el ID del chollo a un entero
        $chollo_id = intval(recoge('chollo_id'));
        $user_id = $_SESSION['userLogin']['id'];

        $pdo = conectaDb();

        $consulta = "SELECT * FROM usuarios WHERE id = $user_id;";

        $resultado = $pdo->query($consulta);
        $resultado = $resultado->fetch(PDO::FETCH_ASSOC);

        // Decodificar el array de chollos guardados
        $chollosGuardados = json_decode($resultado['chollos_guardados'], true);

        // Inicializar como un array vacío si es null
        if ($chollosGuardados === null) {
            $chollosGuardados = [];
        }

        // Asegurar que los índices del array son numéricos
        $chollosGuardados = array_values($chollosGuardados);

        // Verificar si el chollo ya está en la lista
        $cholloIndex = array_search($chollo_id, $chollosGuardados);

        if ($cholloIndex !== false) {
            $_SESSION['userShare'] = 'Chollo eliminado';
            unset($chollosGuardados[$cholloIndex]);
        } else {
            $_SESSION['userLog'] = 'Chollo guardado';
            $chollosGuardados[] = $chollo_id;
        }

        // Codificar el array actualizado a JSON con JSON_NUMERIC_CHECK
        $chollosGuardadosJson = json_encode($chollosGuardados, JSON_NUMERIC_CHECK);

        // Actualizar la base de datos
        $consulta_update = "UPDATE usuarios SET chollos_guardados = :chollosGuardados WHERE id = :userId";
        $stmt = $pdo->prepare($consulta_update);
        $stmt->bindParam(':chollosGuardados', $chollosGuardadosJson, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../chollos_guardados.php");
        exit();
    }
?>
