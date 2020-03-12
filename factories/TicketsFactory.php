<?php

use AniketMagadum\Helpdesk\Models\Ticket;
use AniketMagadum\Helpdesk\Models\Category;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'category' => factory(Category::class)->create()->id
    ];
});
