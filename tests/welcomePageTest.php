<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class welcomPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
            ->see('Welcome To eVolunt');
    }

    public function SignUpButton()
    {
        $this->visit('/')
            ->click('Sign up')
            ->seePageIs('/signup');
    }

    public function SingInButton()
    {
        $this->visit('/')
            ->click('Sign in')
            ->seePageIs('/signin');
    }


    public function JoinButton()
    {
        $this->visit('/')
            ->click('JOIN')
            ->seePageIs('/signup');
    }

    public function eVouluntButton()
    {
        $this->visit('/')
            ->click('eVolunt')
            ->seePageIs('/');
    }
}
