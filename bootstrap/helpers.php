<?php

function env($key, $default)
{
    $value = getenv($key);

    if ($value === false) {
        $value = $default;
    }

    return $value;
}