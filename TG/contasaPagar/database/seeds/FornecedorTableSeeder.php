<?php

use Illuminate\Database\Seeder;

class FornecedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Fornecedor::class, 20)->create();
    }
}
