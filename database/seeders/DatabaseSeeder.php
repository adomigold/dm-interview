<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        // add role to user
        $user = \App\Models\User::first();
        $user->assignRole('super-admin');

        // add permissions to role
        $user->roles->first()->givePermissionTo([
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ]);
    }
}
