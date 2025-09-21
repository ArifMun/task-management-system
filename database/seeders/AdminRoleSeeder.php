<?php

namespace Database\Seeders;

use Artisan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        // pastikan role admin ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // generate ulang permission jika belum ada
        if (Permission::count() === 0) {
            Artisan::call('shield:generate');
        }

        // kasih semua permission ke admin
        $adminRole->syncPermissions(Permission::all());

        // opsional: assign role admin ke user pertama
        $user = User::first();
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }
    }
}
