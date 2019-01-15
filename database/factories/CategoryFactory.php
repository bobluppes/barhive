<?php

use Faker\Generator as Faker;

$factory->define(App\ProductCategory::class, function (Faker $faker) {
    return [
        'sName' => $faker->unique()->name,
        'sMakeOrder' => $faker->randomElement(['none', 'kitchen', 'bar']),
    ];
});
