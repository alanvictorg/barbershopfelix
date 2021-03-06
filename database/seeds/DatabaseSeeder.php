<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PricesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
