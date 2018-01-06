<?php

namespace David\Foundation;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Illuminate\Support\Arr;

class Route
{
    public $nameSpace = "\\App\\Controllers";

    public function dispatch($routerFile)
    {
        // 格式化路由文件成一个数组
        $routerFile = Arr::wrap($routerFile);

        // 添加路由
        $dispatcher = simpleDispatcher(function(RouteCollector $router) use ($routerFile) {
            foreach ($routerFile as $file) {
                require $file;
            }
        });

        // 解析路由
        return $dispatcher->dispatch($this->getHttpMethod(), $this->getHttpUri());
    }


    protected function getHttpMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function getHttpUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }


}