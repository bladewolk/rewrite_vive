<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'password' => 'secret',
        'isAdmin' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Device::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\Price::class, function ($faker) {
    return [
        'minTime' => $faker->randomDigit,
        'value' => $faker->randomDigit,
        'device_id' => function () {
            return factory(App\Models\Device::class)->create()->id;
        }
    ];
});
