<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// random float randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)
use \App\Consumer;

$factory->define(App\Order::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->unique()->uuid,
        'consumer_id' => Consumer::all()->random()->id,
        'number' => $faker->unique->randomNumber(3),
        'emission_date' => $faker->date(),
        'total' => 0
    ];
});
