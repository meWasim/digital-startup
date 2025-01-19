<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Step 1: Define permissions
        $adminPermissions = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'view-permissions',
            'create-permissions',
            'edit-permissions',
            'delete-permissions',
            'view-tamplates',
            'create-blog',
            'edti-blog',
            'show-blog',
            'delete-blog',
            'contact',
            'discuss-project',

        ];

        $userPermissions = [
            'create-blog',
            'edti-blog',
            'show-blog',
            'delete-blog'
        ];

        // Step 2: Create permissions in the database
        $allPermissions = array_unique(array_merge($adminPermissions, $userPermissions));
        foreach ($allPermissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // Step 3: Create roles
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Step 4: Assign permissions to roles
        $userRole->syncPermissions($userPermissions);
        $adminRole->syncPermissions($adminPermissions);

        // Step 5: Create a regular user and assign the 'user' role
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'Fname' => 'John',
                'Lname' => 'Doe',
                'role' => 'user',
                'registration_countrycode' => 'US',
                'telephone' => '1234567890',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($userRole);

        // Step 6: Create an admin user and assign the 'admin' role
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'Fname' => 'Admin',
                'Lname' => 'User',
                'role' => 'admin',
                'registration_countrycode' => 'US',
                'telephone' => '9876543210',
                'password' => Hash::make('password'),
                'subdomain' => 'admin-subdomain' // Add a unique subdomain
            ]
        );
        $admin->assignRole($adminRole);

        echo "Users, roles, and permissions have been created successfully.\n";
    }
}
