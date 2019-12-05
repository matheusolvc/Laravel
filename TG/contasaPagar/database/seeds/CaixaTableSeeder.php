<?php

use Illuminate\Database\Seeder;

class CaixaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Caixa::class, 1)->create();
    }
}
