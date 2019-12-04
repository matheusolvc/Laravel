<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Conta;
use Faker\Generator as Faker;
use JansenFelipe\FakerBR\FakerBR;

$factory->define(Conta::class, function (Faker $faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'status'            => 'A',
        'dt_criacao'        => Carbon\Carbon::now(),
        'dt_alteracao'      => null,
        'dt_emissao'        => Carbon\Carbon::now(),
        'dt_vencimento'     => Carbon\Carbon::now()->addDays($faker->numberBetween($min = 1, $max = 15)),
        'dt_pagamento'      => null,
        'id_renegociacao'   => null,
        'valor_documento'   => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.1, $max = 2000),
        'multa'             => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'juros'             => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'id_usuario'        => 1,
        'num_doc'           => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'serie'             => null,
    ];
});

$factory->state(\App\Models\Conta::class, 'boleto', function ($faker) {
    return [
        'tipo_conta'        => 'B',
        'codigo_barras' => ''.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 5, $strict = false).' '.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 6, $strict = false).' '.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 6, $strict = false).' '.$faker->randomDigit().' '.$faker->randomNumber($nbDigits = 7, $strict = false).''.$faker->randomNumber($nbDigits = 7, $strict = false).'',
        'id_fornecedor' => $faker->numberBetween($min = 1, $max = 20),
    ];
});

$factory->state(\App\Models\Conta::class, 'imposto', function ($faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'tipo_conta'            => 'I',
        'periodo_apuracao'  => Carbon\Carbon::now()->addDays($faker->numberBetween($min = 1, $max = 15)),
        'cod_imposto'       => $faker->randomElement($array = array ('0561','1097','5123', '1708', '2089', '2172', '237', '3208', '5952', '6106', '8045', '8109', '8301')),
        'codigo_barras'     => ''.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 5, $strict = false).' '.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 6, $strict = false).' '.$faker->randomNumber($nbDigits = 5, $strict = false).'.'.$faker->randomNumber($nbDigits = 6, $strict = false).' '.$faker->randomDigit().' '.$faker->randomNumber($nbDigits = 7, $strict = false).''.$faker->randomNumber($nbDigits = 7, $strict = false).'',
        'cnpj_matriz'       => $faker->cnpj,
    ];
});

$factory->state(\App\Models\Conta::class, 'notaFiscal', function ($faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'tipo_conta'            => 'N',
        'id_fornecedor'     => $faker->numberBetween($min = 1, $max = 20),
    ];
});

$factory->state(\App\Models\Conta::class, 'outra', function ($faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'tipo_conta'            => 'O',
        'id_fornecedor'     => $faker->numberBetween($min = 1, $max = 20),
    ];
});

$factory->state(\App\Models\Conta::class, 'reembolso', function ($faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'tipo_conta'        => 'R',
        'id_colaborador'    => $faker->numberBetween($min = 1, $max = 10),
        'dt_recibo'         => Carbon\Carbon::now()->addDays($faker->numberBetween($min = 0, $max = 7)),
        'descricao'         => $faker->sentence($nbWords = 12, $variableNbWords = true),
    ];
});
