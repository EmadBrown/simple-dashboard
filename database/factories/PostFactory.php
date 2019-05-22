<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $faker->text('30'),
        'user_id' => $factory->create(App\User::class)->id,
        'body' => $faker->text('600'),
        'cover_image' => $faker->imageUrl(300, 600),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
