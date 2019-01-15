<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'sName' => $faker->unique()->name,
        'sDescription' => $faker->randomElement(['none', 'kitchen', 'bar']),
        'fPrice' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.5, $max = 10),
        'iCategoryId' => $faker->numberBetween($min = 1, $max = 10),
        'bActive' => true,
        'bOrderComment' => $faker->randomElement([true, false]),
    ];
});
