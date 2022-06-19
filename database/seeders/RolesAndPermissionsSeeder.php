<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'buy']);
        Permission::create(['name' => 'sell']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'publish products']);
        Permission::create(['name' => 'unpublish products']);
        Permission::create(['name' => 'in stock']);
        Permission::create(['name' => 'out of stock']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role1 = Role::create(['name' => 'buyer']);
        $role1->givePermissionTo('buy');

        // or may be done by chaining
        $role2 = Role::create(['name' => 'seller'])
            ->givePermissionTo(['create', 'publish products', 'unpublish products', 'in stock', 'out of stock']);
        
        $role3 = Role::create(['name' => 'admin'])
            ->givePermissionTo(['create', 'edit', 'delete', 'unpublish products']);

        $role4 = Role::create(['name' => 'super-admin']);
        $role4->givePermissionTo(Permission::all());

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Buyer',
            'email' => 'buyer@buyer.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Seller',
            'email' => 'seller@seller.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
        ]);
        $user->assignRole($role4);
    }
}
