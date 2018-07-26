<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// random float randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)

$factory->define(App\Consumer::class, function (Faker\Generator $faker) {
 $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));

    return [
        'id' => $faker->unique()->uuid,
        'name' => $faker->unique()->firstName(),
        'birth_date' => $faker->date(),
        'cpf' => $faker->cpf(false),
    ];
});
