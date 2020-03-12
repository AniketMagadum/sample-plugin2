<?php

use Faker\Generator as Faker;
use RainLab\User\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => "password",
        'password_confirmation' => "password",
    ];
});

$factory->state(User::class, 'activated', function () {
    return [
        'is_activated' => true,
        'activated_at' => now()
    ];
});
