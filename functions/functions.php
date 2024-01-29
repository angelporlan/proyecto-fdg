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
    }

    if ($diferencia->m > 0) {
        $formato .= 'Hace ' . $diferencia->m . ' mes' . ($diferencia->m > 1 ? 'es' : '') . ' ';
    }

    if ($diferencia->d > 0) {
        $formato .= 'Hace ' . $diferencia->d . ' día' . ($diferencia->d > 1 ? 's' : '') . ' ';
    }

    if ($diferencia->h > 0) {
        $formato .= 'Hace ' . $diferencia->h . ' hora' . ($diferencia->h > 1 ? 's' : '') . ' ';
    }

    if ($diferencia->i > 0) {
        $formato .= 'Hace ' . $diferencia->i . ' minuto' . ($diferencia->i > 1 ? 's' : '') . ' ';
    }

    if (empty($formato)) {
        return 'Hace unos momentos';
    }

    return $formato;
}
