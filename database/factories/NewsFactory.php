<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    static $password;
    return [
        'title' => $faker->sentence,
        'summary' => $faker->paragraph,
        'position' => $faker->boolean(80) ? $position++ : null
    ];
});
