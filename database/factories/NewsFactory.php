<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    $maxPosition = DB::table('news')->max('position');
    return [
        'title' => $faker->sentence,
        'summary' => $faker->paragraph,
        'position' => $faker->boolean(80) ? $maxPosition + 1 : null
    ];
});
