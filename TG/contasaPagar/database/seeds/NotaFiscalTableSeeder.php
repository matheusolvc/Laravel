<?php

use Illuminate\Database\Seeder;

class NotaFiscalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Conta::class, 5)->state('notaFiscal')->create();
    }
}
