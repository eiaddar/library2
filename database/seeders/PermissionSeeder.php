<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Clear existing permissions and roles
        Permission::query()->delete();
        Role::query()->delete();

        // Recreate the cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'assign roles',

            // Book permissions
            'view books',
            'add books',
            'edit books',
            'delete books',
            'manage book categories',

            // Category permissions
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Member permissions
            'view members',
            'add members',
            'edit members',
            'delete members',

            // Borrow/Return permissions
            'issue books',
            'return books',
            'view book issues',
            'manage fines',

            // Settings
            'manage settings',
            'view reports',
            'generate reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign created permissions

        // Super Admin - gets all permissions
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - gets most permissions except user/role management
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $adminPermissions = array_filter($permissions, function($permission) {
            return !in_array($permission, ['view roles', 'create roles', 'edit roles', 'delete roles', 'assign roles']);
        });
        $admin->givePermissionTo($adminPermissions);

        // Librarian - can manage books, categories and members, but not system settings
        $librarian = Role::create(['name' => 'Librarian', 'guard_name' => 'web']);
        $librarianPermissions = [
            'view books', 'add books', 'edit books', 'delete books',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view members', 'add members', 'edit members',
            'issue books', 'return books', 'view book issues', 'manage fines',
            'view reports', 'generate reports'
        ];
        $librarian->givePermissionTo($librarianPermissions);

        // Member - basic permissions
        $member = Role::create(['name' => 'Member', 'guard_name' => 'web']);
        $memberPermissions = [
            'view books', 'view members', 'view book issues'
        ];
        $member->givePermissionTo($memberPermissions);
    }
}
