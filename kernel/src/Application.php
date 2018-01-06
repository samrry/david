<?php

namespace David;

use David\Foundation\Route;
use Illuminate\Container\Container;


class Application extends Container
{
    public $basePath;
    public $router;

    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;

        $this->initConfig();

        $this->bootstrapContainer();

        $this->bootstrapRouter();
        // $this->registerError();
    }

    protected function initConfig()
    {
        // 设置时区
        date_default_timezone_set(env('TIME_ZONE', 'PRC'));
    }

    protected function bootstrapContainer()
    {
        static::setInstance($this);
        $this->instance('app', $this);
    }

    protected function bootstrapRouter()
    {
        $this->router = new Route();
    }
}