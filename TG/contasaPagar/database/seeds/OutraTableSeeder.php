<?php

use Illuminate\Database\Seeder;

class OutraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Conta::class, 10)->state('outra')->create();
    }
}
