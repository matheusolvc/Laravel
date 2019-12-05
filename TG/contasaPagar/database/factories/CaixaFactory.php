<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Caixa;
use Faker\Generator as Faker;

$factory->define(Caixa::class, function (Faker $faker) {
    return [
        'saldo' => $faker->numberBetween($min = 1000, $max = 10000)
    ];
});
