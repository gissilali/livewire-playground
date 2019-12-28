<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph(4),
        'user_id' => $faker->numberBetween(1, 200)
    ];
});
