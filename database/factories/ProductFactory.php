<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// random float randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->uuid,
        'code' => $faker->randomNumber(5),
        'name' => $faker->firstName(),
        'price' => $faker->randomFloat(2, 0, 10000),
    ];
});
