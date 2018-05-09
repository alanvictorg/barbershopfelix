<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 16,
                'name' => 'Corte na Máquina',
                'description' => 'Corte na Máquina',
            ]
        );
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 21,
                'name' => 'Corte Social',
                'description' => 'Corte Social',
            ]
        );
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 26,
                'name' => 'Corte Degradê',
                'description' => 'Corte Degradê',
            ]
        );
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 16,
                'name' => 'Barba',
                'description' => 'Barba',
            ]
        );
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 16,
                'name' => 'Pigmentação',
                'description' => 'Pigmentação',
            ]
        );
        \Illuminate\Support\Facades\DB::table('products')->insert(
            [
                'price_id' => 61,
                'name' => 'Pomada',
                'description' => 'Pomada',
            ]
        );
    }
}
