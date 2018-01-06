<?php

namespace David;

use David\Foundation\Route;
use Illuminate\Cache\CacheManager;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;


class Application extends Container
{
    public $basePath;
    public $router;

    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;

        $this->bootstrapContainer();

        $this->bootstrapRouter();

        $this->bootstrapServices();
        // $this->registerError();
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

    protected function bootstrapServices()
    {
        require $this->basePath . '/bootstrap/helpers.php';
        // 设置时区
        date_default_timezone_set(env('TIME_ZONE', 'PRC'));

        // 后期优化，统一封装成 bootstrap 方法，循环加载
        $this->loadConfiguration();

        $this->loadEloquent();
    }

    protected function loadConfiguration()
    {
        $this->instance('config', $repository = new Repository());

        // dd($this->make('config'));
        $files = $this->getConfigurationFiles($this);

        foreach ($files as $key => $path) {
           $repository->set($key, require $path);
        }
    }

    protected function getConfigurationFiles($app)
    {
        $configPath = $this->basePath . '/config';

        $configFiles = [];
        foreach (scandir($configPath) as $file) {
            $file = $configPath . '/' . $file;

            if (is_file($file)) {
                $key = rtrim(basename($file), '.php');
                $configFiles[$key] = $file;
            }
        }


        return $configFiles;
    }

    protected function loadEloquent()
    {
        $capsule = new Manager($this);

        // 创建链接
        $capsule->addConnection(config('database'));

        // 设置全局静态可访问
        $capsule->setAsGlobal();

        // 启动Eloquent
        $capsule->bootEloquent();
    }
}