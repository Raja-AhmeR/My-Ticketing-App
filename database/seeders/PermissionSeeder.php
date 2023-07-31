<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'admin.new-agent',
            'admin.create-agent',
            'admin.store-agent',
            'admin.delete-agent',
            'view-ticket',
            'create-ticket',
            'store-ticket',
            'show-ticket',
            'edit-ticket',
            'update-ticket',
            'delete-ticket',
            'assign-to-agent',
            'ticket-log',
            'admin.view-category',
            'admin.create-category',
            'admin.store-category',
            'admin.edit-category',
            'admin.update-category',
            'admin.delete-category',
            'admin.view-label',
            'admin.create-label',
            'admin.store-label',
            'admin.edit-label',
            'admin.update-label',
            'admin.delete-label',
            'admin.role-view',
            'admin.permission-view',
            'admin.update-permission'
        ];
        foreach ($permissions as $permission) {
            $check = Permission::where('name', $permission)->first();
            if (!isset($check)) {
                Permission::create(['name' => $permission]);
            }
        }



        // reset cached roles and permissions
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // $admin = Role::find(1);
        // if (empty($admin)) {
        //     $admin =  Role::create(['name' => 'admin']);
        // }

        // $agent = Role::find(2);
        // if (empty($agent)) {
        //     $agent = Role::create(['name' => 'agent']);
        // }

        // $user = Role::find(3);
        // if (empty($user)) {
        //     $user = Role::create(['name' => 'user']);

        // }

        // $permissions = [
        //     'admin.new-agent',
        //     'admin.create-agent',
        //     'admin.store-agent',
        //     'view-ticket',
        //     'edit-ticket',
        // ];
        // foreach ($permissions as $permission) {
        //     $check = Permission::where('name', $permission)->first();
        //     if (!isset($check)) {
        //         Permission::create(['name' => $permission]);
        //     }
        // }
        // $adminUser = User::find(1);
        // $adminUser->assignRole($admin);
        // $agentUSer = User::find(2);
        // $agentUSer->assignRole($agent);
        // (new Role())->find(1)->givePermissionTo((new Permission())->pluck('id'));

        // $agent->givePermissionTo(['view-ticket']);


    }
}
