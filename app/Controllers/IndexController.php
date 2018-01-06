<?php

namespace App\Controllers;

class IndexController
{
    public function index($name)
    {
        return "hello {$name}";
    }
}