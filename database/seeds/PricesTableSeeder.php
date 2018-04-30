<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($cont = 0.00; $cont <= 60.00; $cont++) {
            \Illuminate\Support\Facades\DB::table('prices')->insert([
                'price' => $cont,
            ]);
        }
    }
}
