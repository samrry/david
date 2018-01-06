<?php

namespace David;

use FastRoute\Route;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Config;

class Application extends Container
{
    protected $basePath;

    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;

        $this->initConfig();

        $this->bootstrapContainer();


        // $this->registerError();
    }

    protected function initConfig()
    {
        require $this->basePath . '/bootstrap/helpers.php';

        // 设置时区
        date_default_timezone_set(env('TIME_ZONE', 'PRC'));
    }

    protected function bootstrapContainer()
    {
        static::setInstance($this);
        $this->instance('app', $this);
    }
}