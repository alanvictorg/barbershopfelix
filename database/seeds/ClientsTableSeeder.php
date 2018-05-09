<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('clients')->insert(
            [
                'name' => 'Alan Victor',
                'phone' => '989029381',
                'instagram' => 'alanvictorgp',
                'address' => 'Rua 3',
                'email' => 'alanvictorg@hotmail.com',
                'birthday' => '2018/05/01'
            ]
        );
    }
}
