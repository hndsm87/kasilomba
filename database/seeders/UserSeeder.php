<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        $judgeRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Judge']);

        // 2. Create Admin User
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@kasiinfo.id'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Create Judges
        $judge1 = \App\Models\User::firstOrCreate(
            ['email' => 'juri1@kasiinfo.id'],
            [
                'name' => 'Juri Utama',
                'password' => \Illuminate\Support\Facades\Hash::make('juri12345'),
            ]
        );
        $judge1->assignRole($judgeRole);

        $judge2 = \App\Models\User::firstOrCreate(
            ['email' => 'juri2@kasiinfo.id'],
            [
                'name' => 'Juri Teknis',
                'password' => \Illuminate\Support\Facades\Hash::make('juri12345'),
            ]
        );
        $judge2->assignRole($judgeRole);
    }
}
