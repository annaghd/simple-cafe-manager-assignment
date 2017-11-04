<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the role table seeds.
     *
     * @return void
     */
    public function run()
    {
        // save manager role
        $role_manager = new Role();
        $role_manager->name = 'manager';
        $role_manager->save();

        // save waiter role
        $role_waiter = new Role();
        $role_waiter->name = 'waiter';
        $role_waiter->save();
    }
}
