<?php

use Illuminate\Database\Seeder;
use \App\Entities\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrador do Sistema'
            ]);

        Role::create(
            [
                'name' => 'Barbeiro',
                'slug' => 'barber',
                'description' => 'Barbeiro'
            ]);
    }
}
