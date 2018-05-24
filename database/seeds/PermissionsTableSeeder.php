<?php

use Illuminate\Database\Seeder;
use \App\Entities\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(
            [
                'name' => 'User',
                'slug' => 'users',
                'description' => 'Usuários do Sistema'
            ]);

        Permission::create(
            [
                'name'=>'Clientes',
                'slug'=>'clients',
                'description'=>'clients'
            ]);

        Permission::create(
            [
                'name'=>'Produtos',
                'slug'=>'products',
                'description'=>'products'
            ]);

        Permission::create(
            [
                'name'=>'Agendamentos',
                'slug'=>'schedules',
                'description'=>'schedules'
            ]);

        Permission::create(
            [
                'name'=>'Fluxo',
                'slug'=>'cashflows',
                'description'=>'cashflows'
            ]);
    }
}
