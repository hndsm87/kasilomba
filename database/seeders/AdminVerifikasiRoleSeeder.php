<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminVerifikasiRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin Verifikasi']);
        
        // Optional: Create a dummy user for testing
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'verifikator@kasiinfo.id'],
            [
                'name' => 'Admin Verifikasi',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );
        $user->assignRole($role);
    }
}
