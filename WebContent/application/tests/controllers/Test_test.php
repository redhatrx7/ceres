<?php

use PHPUnit\Framework\TestCase;

class Test_test extends TestCase
{
	public function setUp(){parent::setUp();}
	public function tearDown(){parent::tearDown();}
	public function test_get_user()
    {
        $output = $this->request('GET', ['Test', 'user']);
        $this->assertContains('yes', $output);
    }
}