<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StockTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = new \evolunt\User(array('name' => 'John'));

        $this->actingAs($user)
            ->visit('/items')
            ->see('Donate');
    }

    /**
     * checks the donation proses
     * by clicking the donate
     * button and submitting
     * the required fields
     * */
    public function testDonateItem()
    {

        $user = new \evolunt\User(array('user_id'=>2));

       $this->actingAs($user)
            ->visit('/items')
            ->click('Donate')
            ->see('Donate an item');

    }
}
