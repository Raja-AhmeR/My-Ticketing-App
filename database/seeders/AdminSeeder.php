<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123')
        ]);

        $adminUser->role()->attach(1);

        $adminPermissions = Role::find(1);
        $permissionAssigned = Permission::get()->pluck('id')->toArray();
        // dd($permissionAssigned);
        $adminPermissions->permissions()->attach($permissionAssigned);
    }
}
