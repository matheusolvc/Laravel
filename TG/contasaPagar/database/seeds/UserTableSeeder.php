<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\User::class, 1)->state('g')->create();

        factory(\App\Models\User::class, 1)->state('colaborador')->create();

        factory(\App\Models\User::class, 5)->create();

        factory(\App\Models\User::class, 1)->state('gerente')->create();

        factory(\App\Models\User::class, 1)->state('assistente')->create();
    }
}
