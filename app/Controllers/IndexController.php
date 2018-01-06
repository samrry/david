<?php

namespace App\Controllers;

use App\Models\User;

class IndexController
{
    public function index($name)
    {
        return "hello {$name}";
    }
}