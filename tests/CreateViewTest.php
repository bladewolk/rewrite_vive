<?php

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    use DatabaseMigrations;
//    use DatabaseTransactions;
    public $price = 1.7;
    public $duration = 12;
    public $user;

    public function Login()
    {
        $this->user = factory(App\Models\User::class)->create();

        $this->seeInDatabase('users', [
            'name' => $this->user->name,
            'username' => $this->user->username,
            'password' => $this->user->password
        ])
            ->visit('/')
            ->type($this->user->username, 'username')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('/admin/users')
            ->seePageIs('/admin/users');
    }

    public function createDevice()
    {
        $this->visit('/admin/devices')
            ->seePageIs('/admin/devices')
            ->click("New")
            ->type('Oculus', 'name')
            ->press('Create')
            ->seeInDatabase('devices', [
                'name' => 'Oculus',
            ])
            ->seePageIs('/admin/devices')
            ->see('Device name: Oculus');
    }

    public function createPrice()
    {
        $this->visit('/admin/prices')
            ->seePageIs('/admin/prices')
            ->click("New Price")
            ->type('1', 'minTime')
            ->type($this->price, 'value')
            ->press('Create')
            ->seeInDatabase('prices', [
                'minTime' => '1',
                'value' => $this->price
            ])
            ->seePageIs('/admin/prices')
            ->see('Min Time: 1')
            ->see('Price: 1.7');
    }

    public function createUser()
    {
        $this->visit('/admin/users')
            ->seePageIs('/admin/users')
            ->click("Add new")
            ->type('Oksana', 'name')
            ->type('oksana', 'username')
            ->type('123qwe', 'password')
            ->press('Create')
            ->seePageIs('/admin/users')
            ->see('Name: Oksana')
            ->see('Username: oksana');
    }

    public function createEvent()
    {
        $this->visit('/')
            ->seePageIs('/')
            ->type($this->duration, 'duration')
            ->press('Add')
            ->seePageIs('/')
            ->see('Name: ' . $this->user->name)
            ->see('Device: Oculus')
            ->see('Duration: 12')
            ->see('Price: ' . $this->price * $this->duration);
    }

    public function editUser()
    {
        $this->visit('/admin/users/2/edit')
            ->type('Yurec', 'name')
            ->type('yurchik', 'username')
            ->type('123qwe', 'password')
            ->press('Save')
            ->seePageIs('/admin/users');
        $this->seeInDatabase('users', [
            'name' => 'Yurec',
            'username' => 'yurchik'
        ]);
    }

    public function testExample()
    {
        $this->Login();
        $this->editUser();
//        $this->createUser();
//        $this->createDevice();
//        $this->createPrice();
//        $this->createEvent();
    }
}
