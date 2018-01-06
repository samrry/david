<?php

namespace David\Foundation;

use Closure;
use David\Application;
use FastRoute\Dispatcher;

class Kernel
{
    public $router;

    public function __construct(Route $router)
    {
        $this->router = $router;
    }

    public function capture($routeFiles)
    {
        return $this->router->dispatch($routeFiles);
    }

    public function handle(array $request)
    {
        $status = array_shift($request);

        if ($status == Dispatcher::NOT_FOUND) {
            dd('404');
        } elseif ($status == Dispatcher::METHOD_NOT_ALLOWED) {
            dd('方法未允许');
        }

        list($concrete, $parameters) = $request;
        return $this->prepareDestination($concrete, $parameters);
    }

    protected function prepareDestination($concrete, $parameters)
    {
        if (! ($concrete instanceof Closure)) {
            $concrete = $this->changeClosure($concrete);
        }

        // 第一个参数也接受 [object, method] 类型
        return call_user_func_array($concrete, $parameters);
    }

    protected function changeClosure($concrete)
    {
        list($controller, $method) = $this->explodeAction($concrete);

        $instance = Application::getInstance()->make($controller);

        return [$instance, $method];
    }

    protected function explodeAction($concrete)
    {
        list($controller, $method) = explode('@', $concrete);

        // 控制器的命名空间
        $controller = $this->router->nameSpace . "\\" . $controller;

        return [$controller, $method];
    }
}