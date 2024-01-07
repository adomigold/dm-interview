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
        try {
            \App\Models\User::factory(1)->create();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        // add role to user
        $user = \App\Models\User::first();

        // Create Super Admin Role
        try {
            \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $user->assignRole('super-admin');

        // add permissions to role
        $user->roles->first()->givePermissionTo([
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'assign permissions',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ]);
    }
}
