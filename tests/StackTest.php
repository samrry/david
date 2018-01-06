<?php

namespace test;

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack)
    {
        // 断言为空数组
        $this->assertEquals(0, count($stack));
        array_push($stack, 'foo');
        // 断言第一个值是 foot
        $this->assertEquals('foo', current($stack));
        // 断言数组元素为1
        $this->assertEquals(1, count($stack));
    }
}