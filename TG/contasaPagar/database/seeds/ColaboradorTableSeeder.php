<?php

use Illuminate\Database\Seeder;

class ColaboradorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\Colaborador::class, 10)->create();
    }
}
