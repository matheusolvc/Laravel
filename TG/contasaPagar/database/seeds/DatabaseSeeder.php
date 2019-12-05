<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(FornecedorTableSeeder::class);
        $this->call(ColaboradorTableSeeder::class);
        $this->call(BoletoTableSeeder::class);
        $this->call(ImpostoTableSeeder::class);
        $this->call(NotaFiscalTableSeeder::class);
        $this->call(ReembolsoTableSeeder::class);
        $this->call(OutraTableSeeder::class);
        $this->call(CaixaTableSeeder::class);
    }
}
