<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $role_employee = new Role();
    $role_employee->name = ‘oglasi’;
    $role_employee->description = ‘Moze da postavlja samo oglase’;
    $role_employee->save();
	
    $role_manager = new Role();
    $role_manager->name = dogadjaji;
    $role_manager->description = ‘‘Moze da postavlja samo dogadjaje’;
    $role_manager->save();
    }
}
