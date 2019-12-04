<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use JansenFelipe\FakerBR\FakerBR;

$factory->define(\App\Models\Colaborador::class, function (Faker $faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'cpf'       => $faker->cpf,
        'nome'      => $faker->name($gender = null),
        'matricula' => $faker->randomNumber($nbDigits = 5, $strict = false),
        'cod_banco' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'agencia'   => $faker->randomNumber($nbDigits = 5, $strict = false),
        'conta'     => $faker->randomNumber($nbDigits = 7, $strict = false),
    ];
});
