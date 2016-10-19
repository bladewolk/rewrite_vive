<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->visit('/')
            ->type('admin', 'username')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('/')
            ->type('22', 'duration')
            ->press('Add')
            ->seePageIs('/');
    }
}
