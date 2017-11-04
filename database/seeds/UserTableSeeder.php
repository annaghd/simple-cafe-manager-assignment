<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the user table seeds.
     *
     * @return void
     */
    public function run()
    {
        // get manager and waiter roles
        $role_manager = Role::where('name', '=', 'manager')->first();
        $role_waiter = Role::where('name', '=','waiter')->first();

        // create waiter
        $user = new User();
        $user->name = 'Tom Smith';
        $user->email = 'waiter@waiter.dev';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_waiter);

        // create manager
        $user = new User();
        $user->name = 'Sam Smith';
        $user->email = 'manager@manager.dev';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_manager);

    }
}
