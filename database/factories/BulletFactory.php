<?php

use App\Models\Bullet;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Bullet::class, function (Faker $faker) {
    return [
        'published_at' => now(),
        'bullet' => $faker->realText(),
    ];
});
