<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // some command for fix problem
        // ** "php artisan permission:cache-reset" alias for -> "artisan cache:forget spatie.permission.cache"
        // ** set cache drive to redis or another one
        // ** for team_id error -> set config/permissions.php column_names.team to false



        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'list coins', 'guard_name' => 'web']);
        Permission::create(['name' => 'detail coins', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit coins', 'guard_name' => 'web']);
        Permission::create(['name' => 'add coins', 'guard_name' => 'web']);

        // create viewer role
        $role_viewer = Role::create(['name' => 'viewer', 'guard_name' => 'web']);
        // give permissions to viewer role
        $role_viewer->givePermissionTo('list coins');
        $role_viewer->givePermissionTo('detail coins');

        // create admin role
        $role_admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        // give permissions to admin role
        $role_admin->givePermissionTo('list coins');
        $role_admin->givePermissionTo('detail coins');
        $role_admin->givePermissionTo('edit coins');

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role_super_admin = Role::create(['name' => 'Super-Admin', 'guard_name' => 'web']);

        // assign role to users
        $user_mori = User::where('email', 'mori@lobdown.com')->first();
        $user_mori->assignRole($role_viewer);

        $user_hossein = User::factory()->create([
            'name' => 'Hossein',
            'email' => 'hossein@lobdown.com',
            'password' => '123456789hossein'
        ]);
        $user_hossein->assignRole($role_admin);

        $user_super_admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super_admin@lobdown.com',
            'password' => '123456789super_admin'
        ]);
        $user_super_admin->assignRole($role_super_admin);

    }
}
