<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view news']);
        Permission::create(['name' => 'create news']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'delete news']);
        Permission::create(['name' => 'comment news']);

        //create roles and assign existing permissions

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('comment news');
        $userRole->givePermissionTo('view news');
      

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
    

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@web.com',
            'password' => Hash::make('Admin@123'),
            'role' => 1,
        ]);
        $user->assignRole($superadminRole);

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@web.com',
            'password' =>  Hash::make('User@123'),
            'role' => 2,
        ]);
        $user->assignRole($userRole);


    }
}
