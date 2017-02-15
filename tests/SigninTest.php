<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SigninTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSignin()
    {
        $this->visit('/')
            ->see('Welcome To eVolunt');
    }
}
