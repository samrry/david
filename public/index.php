<?php


$app = require __DIR__ . '/../bootstrap/app.php';


$kernel = $app->make(\David\Foundation\Kernel::class);


// 获取请求
$request = $kernel->capture(
    __DIR__.'/../routes/api.php'
);

// 获取响应
$response = $kernel->handle($request);

// 输出
dd($response);