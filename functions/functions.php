<?php

function recoge($var)
{
    if (isset($_REQUEST[$var])) {
        if ($_REQUEST[$var] != "") {
            $tmp = trim(htmlspecialchars(strip_tags($_REQUEST[$var])));
            return $tmp;
        }
    }
    return null;
}

function tiempoTranscurrido($fechaEnMilisegundos) {
    $fechaInicio = new DateTime("@$fechaEnMilisegundos");
    $fechaActual = new DateTime();

    $diferencia = $fechaInicio->diff($fechaActual);

    $formato = '';

    if ($diferencia->y > 0) {
        $formato .= 'Hace ' . $diferencia->y . ' año' . ($diferencia->y > 1 ? 's' : '') . ' ';
    } elseif ($diferencia->m > 0) {
        $formato .= 'Hace ' . $diferencia->m . ' mes' . ($diferencia->m > 1 ? 'es' : '') . ' ';
    } elseif ($diferencia->d > 0) {
        $formato .= 'Hace ' . $diferencia->d . ' día' . ($diferencia->d > 1 ? 's' : '') . ' ';
    } elseif ($diferencia->h > 0) {
        $formato .= 'Hace ' . $diferencia->h . ' hora' . ($diferencia->h > 1 ? 's' : '') . ' ';
    } else {
        $formato .= 'Hace ' . $diferencia->i . ' minuto' . ($diferencia->i > 1 ? 's' : '') . ' ';
    }

    if (empty($formato)) {
        return 'Hace unos momentos';
    }

    return $formato;
}

function validarEnlace($enlace) {
    $curl = curl_init($enlace);
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $respuesta = curl_exec($curl);
    $error = curl_error($curl);
    
    curl_close($curl);
    
    // Verificar si se obtuvo una respuesta sin errores
    return !empty($respuesta) && !$error;
}


