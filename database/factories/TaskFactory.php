<?php

use Faker\Generator as Faker;

// generating random instances
$factory->define(App\Models\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'is_complete' => $faker->boolean,
    ];
});