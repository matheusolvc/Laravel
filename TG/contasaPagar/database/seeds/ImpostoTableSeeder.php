<?php

use Illuminate\Database\Seeder;

class ImpostoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Conta::class, 10)->state('imposto')->create();
    }
}
