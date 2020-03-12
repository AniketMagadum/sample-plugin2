<?php

use Backend\Models\User as BackendUser;
use Faker\Generator as Faker;

$factory->define(BackendUser::class, function (Faker $faker) {
    return [
        'login' => $faker->userName,
        'email' => $faker->email,
        'password' => "password",
        'password_confirmation' => "password",
    ];
});
