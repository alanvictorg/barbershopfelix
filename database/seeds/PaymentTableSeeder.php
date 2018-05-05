<?php

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('payments')->insert(
            [
                'form_payment' => 'cash',
                'discount' => 1,
                'icon' => 'fa fa-money'
            ]
        );

        \Illuminate\Support\Facades\DB::table('payments')->insert(
            [
                'form_payment' => 'credit_card',
                'discount' => 1.2,
                'icon' => 'fa fa-credit-card'
            ]
        );
    }
}
