<?php



class fundTests extends TestCase
{



    /**
     * A basic test example.
     * vist the fund
     * page and
     * sees the
     * create Fundraiser text
     *
     * @return void
     */
    public function testExample()
    {
        $user = new \evolunt\User(array('name' => 'John'));

        $this->actingAs($user)
             ->visit('/funds')
             ->see('Create Fundraiser');
    }

   
}
