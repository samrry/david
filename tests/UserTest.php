<?php

namespace test;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser()
    {
        $user = User::first();

        $this->assertNotNull($user);
    }
}