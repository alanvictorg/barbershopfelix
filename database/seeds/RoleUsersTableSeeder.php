<?php

use Illuminate\Database\Seeder;
use \App\Entities\RoleUser;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
            'role_id' => 1,
            'user_id' => 1
        ]);
    }
}
