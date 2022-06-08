<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

               // create permissions
               $permissions = [
                'user_management_access',
                'permission_create',
                'permission_edit',
                'permission_show',
                'permission_delete',
                'permission_access',
                'role_create',
                'role_edit',
                'role_show',
                'role_delete',
                'role_access',
                'user_create',
                'user_edit',
                'user_show',
                'user_delete',
                'post_access',
                'post_create',
                'post_edit',
                'post_show',
                'post_delete',
                'comment_create',
                'comment_edit',
                'comment_show',
                'comment_delete',
                'comment_access',

            ];
    
        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }
        
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Super Admin']);

        $admin = Role::create(['name' => 'Admin']);

        $adminPermissions = [
            'user_management_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'post_access',
            'post_create',
            'post_edit',
            'post_show',
            'post_delete',
            'comment_create',
            'comment_edit',
            'comment_show',
            'comment_delete',
            'comment_access',
        ];

        foreach ($adminPermissions as $permission)   {
            $admin->givePermissionTo($permission);
        }

        $user = Role::create(['name' => 'User']);

        $userPermissions = [
            'post_access',
            'post_create',
            'post_edit',
            'post_show',
            'post_delete',
            'comment_create',
            'comment_edit',
            'comment_show',
            'comment_delete',
            'comment_access',
        ];

        foreach ($userPermissions as $permission)   {
            $user->givePermissionTo($permission);
        }
    }
}
