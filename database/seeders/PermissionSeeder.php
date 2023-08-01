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
            [
                'name' => 'admin.new-agent',
                'view_proper_name' => 'Create New Agent'
            ], [
                'name' => 'admin.create-agent',
                'view_proper_name' => 'New Agent Form',

            ], [
                'name' => 'admin.store-agent',
                'view_proper_name' => 'Store Agent',
            ], [
                'name' => 'admin.delete-agent',
                'view_proper_name' => 'Delete Agent',
            ], [
                'name' => 'view-ticket',
                'view_proper_name' => 'View Ticket',
            ], [
                'name' => 'create-ticket',
                'view_proper_name' => 'Create New Ticket',
            ], [
                'name' => 'store-ticket',
                'view_proper_name' => 'Store Ticket',
            ], [
                'name' => 'show-ticket',
                'view_proper_name' => 'Show Individual Ticket',
            ], [
                'name' => 'edit-ticket',
                'view_proper_name' => 'Edit Ticket',
            ], [
                'name' => 'update-ticket',
                'view_proper_name' => 'Update Ticket',
            ], [
                'name' => 'delete-ticket',
                'view_proper_name' => 'Delete Ticket',
            ], [
                'name' => 'assign-to-agent',
                'view_proper_name' => 'Assign Ticket To Agent',
            ], [
                'name' => 'ticket-log',
                'view_proper_name' => 'View Ticket Log',
            ], [
                'name' => 'admin.view-category',
                'view_proper_name' => 'View Category',
            ], [
                'name' => 'admin.create-category',
                'view_proper_name' => 'Create New Category',
            ], [
                'name' => 'admin.store-category',
                'view_proper_name' => 'Store Category',
            ], [
                'name' => 'admin.edit-category',
                'view_proper_name' => 'Edit Category',
            ], [
                'name' => 'admin.update-category',
                'view_proper_name' => 'Update Category',
            ], [
                'name' => 'admin.delete-category',
                'view_proper_name' => 'Delete Category',
            ], [
                'name' => 'admin.view-label',
                'view_proper_name' => 'View Label',
            ], [
                'name' => 'admin.create-label',
                'view_proper_name' => 'Create New Label',
            ], [
                'name' => 'admin.store-label',
                'view_proper_name' => 'Store Label',
            ], [
                'name' => 'admin.edit-label',
                'view_proper_name' => 'Edit Label',
            ], [
                'name' => 'admin.update-label',
                'view_proper_name' => 'Update Label',
            ], [
                'name' => 'admin.delete-label',
                'view_proper_name' => 'Delete Label',
            ], [
                'name' => 'admin.role-view',
                'view_proper_name' => 'View Role',
            ], [
                'name' => 'admin.permission-view',
                'view_proper_name' => 'View Permission',
            ], [
                'name' => 'admin.update-permission',
                'view_proper_name' => 'Update Permission'
            ]
        ];


        foreach ($permissions as $permission) {
            $check = Permission::where('name', $permission['name'])->first();
            if (!isset($check)) {
                Permission::create([
                    'name' => $permission['name'],
                    'view_proper_name' => $permission['view_proper_name']
                ]);
            }
        }

        // foreach ($properNames as $names) {
        //     $check = Permission::where('view_proper_name', $names)->first();
        //     if (!isset($check)) {
        //         Permission::create([
        //             'view_proper_name' => $names
        //         ]);
        //     }
        // }



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
