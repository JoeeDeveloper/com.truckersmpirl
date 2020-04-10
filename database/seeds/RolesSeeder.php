<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator']);
        $manager = Role::create(['name' => 'Manager']);
        $adminAccess = Permission::create(['name' => 'admin access']);
        $manageEvents = Permission::create(['[name]' => 'manage events']);

        $admin->givePermissionsTo($adminAccess, $manageEvents);
        $manager->givePermissionsTo($manageEvents);
    }
}
