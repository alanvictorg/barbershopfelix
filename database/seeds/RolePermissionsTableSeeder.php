<?php

use Illuminate\Database\Seeder;
use \App\Entities\RolePermission;
class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermission::create(['permission_id'=>1,'role_id'=>1]);
        RolePermission::create(['permission_id'=>2,'role_id'=>1]);
        RolePermission::create(['permission_id'=>3,'role_id'=>1]);
        RolePermission::create(['permission_id'=>4,'role_id'=>1]);
        RolePermission::create(['permission_id'=>5,'role_id'=>1]);
    }
}
