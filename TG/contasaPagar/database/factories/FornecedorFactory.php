<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Fornecedor;
use Faker\Generator as Faker;
use JansenFelipe\FakerBR\FakerBR;

$factory->define(Fornecedor::class, function (Faker $faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'cnpj' => $faker->cnpj,
        'razao_social' => $faker->company,
        'cod_banco' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'agencia' => $faker->randomNumber($nbDigits = 5, $strict = false),
        'conta' => $faker->randomNumber($nbDigits = 7, $strict = false),
        'telefone' => $faker->phoneNumber,
        'email' => $faker->email,
        'endereco' => $faker->streetName                          ,
        'numero' => $faker->buildingNumber,
        'bairro' => $faker->streetSuffix,
        'cidade' => $faker->city,
        'uf' => $faker->stateAbbr,
    ];
});
