<?php

if (! function_exists('config')) {
    function config($key, $default = null)
    {
        $value = app('config')->get($key);

        if ($value === false) {
            $value = $default;
        }

        return $value;
    }
}

if (! function_exists('app')) {
    function app($abstract = null, $parameters = [])
    {
        if (is_null($abstract)) {
            return \Illuminate\Container\Container::getInstance();
        }

        return \Illuminate\Container\Container::getInstance()->make($abstract, $parameters);
    }
}