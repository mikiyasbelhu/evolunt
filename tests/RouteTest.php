<?php

/**
 * a simple test to check all routes
 * in the project
 */
class RouteTest extends TestCase
{
    /**
     * A basic unit test example for the
     * home,sign up and sign in pages
     * when the user is not
     * authenticated
     * @return void
     */
    public function testRoutes()
    {
        /**
         * a home page test
         */
        $this->visit('/')
                ->see('Welcome To eVolunt');
        /**
         * a Sign Up test
         */
        $this->visit('signup')
            ->see('Sign up');

        /**
         * a Sign in test
         */
        $this->visit('signin')
            ->see('Sign in');
    }

    /**
     * A test for all the links
     * when the user is not
     * authenticated
     * @return void
     */
    function testNotAuth()
    {

        /**
         * Message when not Authenticated
         */

        $this->visit('messages')
            ->see('You need to sign in first');

        /**
         * Friends when not Authenticated
         */

        $this->visit('friends')
            ->see('You need to sign in first');

        /**
         * Events when not Authenticated
         */

        $this->visit('events')
            ->see('You need to sign in first');

        /**
         * Funds when not Authenticated
         */

        $this->visit('funds')
            ->see('You need to sign in first');

        /**
         * Funds when not Authenticated
         */

        $this->visit('items')
            ->see('You need to sign in first');
    }

    /**
     * A test for all the links
     * when the user is
     * authenticated
     * @return void
     */
    function testAuthRoute()
    {
        $user = new \evolunt\User(array('username'=>'TestDummy'));
        $this->be($user);

        /**
         * Message when Authenticated
         */

        $this->visit('messages')
            ->see('Recent Messages');

        /**
         * Friends when Authenticated
         */

        $this->visit('friends')
            ->see('Your followers');

        /**
         * Events when Authenticated
         */

        $this->visit('events')
            ->see('Create event');

        /**
         * Funds when Authenticated
         */

        $this->visit('funds')
            ->see('Create Fundraiser');

        /**
         * Funds when Authenticated
         */

        $this->visit('items')
            ->see('Your donations');
    }

}