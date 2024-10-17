<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch roles
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'auther')->first();
        $userRole = Role::where('name', 'user')->first();

        if (!$superAdminRole || !$adminRole || !$authorRole || !$userRole) {
            throw new \Exception('Roles are missing. Make sure to run RoleSeeder first.');
        }

        // Create a superadmin user
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'role_id' => $superAdminRole->id
            ]
        );

        // Create an admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role_id' => $adminRole->id
            ]
        );

        // Create an author user
        User::updateOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Auther',
                'password' => bcrypt('password'),
                'role_id' => $authorRole->id
            ]
        );

        // Create a normal user
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'password' => bcrypt('password'),
                'role_id' => $userRole->id
            ]
        );
    }




}
