<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// random float randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->unique()->uuid,
        'code' => $faker->unique()->randomNumber(5),
        'name' => $faker->unique()->firstName(),
        'price' => $faker->randomFloat(2, 0, 1000),
    ];
});
