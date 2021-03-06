<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use JansenFelipe\FakerBR\FakerBR;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'name' => $faker->name,
        'tipo_usuario' => 'C',
        'matricula' => $faker->randomNumber($nbDigits = 5, $strict = false),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(\App\Models\User::class, 'colaborador', function ($faker) {
    return [
        'name' => 'Carlos Almeida',
        'matricula' => '23456',
        'email' => 'colaborador@colaborador',
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(\App\Models\User::class, 'g', function ($faker) {
    return [
        'name' => 'Augusto Almeida',
        'tipo_usuario' => 'G',
        'matricula' => '34567',
        'email' => 'gerente@gerente',
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(\App\Models\User::class, 'gerente', function ($faker) {
    return [
        'tipo_usuario' => 'G',
    ];
});


$factory->state(\App\Models\User::class, 'assistente', function ($faker) {
    return [
        'tipo_usuario' => 'A',
    ];
});
