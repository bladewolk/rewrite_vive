<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use DatabaseTransactions;
    public $device;
    public $price;
    public $event;
    public $duration = 12;

    public function createUser()
    {
        $user = factory(App\Models\User::class)->create();

        $this->seeInDatabase('users', [
            'name' => $user->name,
            'username' => $user->username,
            'password' => $user->password
        ]);
    }

    public function createDevice()
    {
        $this->device = factory(App\Models\Device::class)->create();
        $this->seeInDatabase('devices', [
            'name' => $this->device->name
        ]);
    }

    public function createPrice()
    {
        $this->price = factory(App\Models\Price::class)->create([
            'minTime' => '1',
            'value' => '1.7',
            'device_id' => $this->device->id
        ]);
        $this->seeInDatabase('prices', [
            'minTime' => '1',
            'value' => '1.7',
            'device_id' => $this->device->id
        ]);
    }

    public function createEvent()
    {
        $this->event = factory(\App\Models\Event::class)->create([
            'status' => 'active',
            'device_id' => $this->device->id,
            'duration' => $this->duration,
            'total_price' => (float)($this->price * $this->duration)
        ]);

        $this->seeInDatabase('events', [
            'status' => 'active',
            'device_id' => $this->device->id,
            'duration' => $this->duration,
            'total_price' => (float)($this->price * $this->duration)
        ]);
    }

    public function testExample()
    {
        $this->createUser();
        $this->createDevice();
        $this->createPrice();
//        TODO App\Models\Price could not be converted to int
//        $this->createEvent();
    }
}
