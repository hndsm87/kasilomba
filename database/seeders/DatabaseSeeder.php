<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Criteria;
use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $judgeRole = Role::firstOrCreate(['name' => 'Judge']);

        // 2. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@kasiinfo.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Create Judges
        $judge1 = User::firstOrCreate(
            ['email' => 'judge1@kasiinfo.id'],
            [
                'name' => 'Head Judge',
                'password' => Hash::make('password'),
            ]
        );
        $judge1->assignRole($judgeRole);

        $judge2 = User::firstOrCreate(
            ['email' => 'judge2@kasiinfo.id'],
            [
                'name' => 'Technical Judge',
                'password' => Hash::make('password'),
            ]
        );
        $judge2->assignRole($judgeRole);

        // 4. Seed Criterias
        Criteria::firstOrCreate(
            ['name' => 'Relevance to Theme'],
            ['category' => 'all', 'weight' => 30, 'order' => 1]
        );
        Criteria::firstOrCreate(
            ['name' => 'Composition'],
            ['category' => 'all', 'weight' => 30, 'order' => 2]
        );
        Criteria::firstOrCreate(
            ['name' => 'Technical Quality'],
            ['category' => 'all', 'weight' => 20, 'order' => 3]
        );
        Criteria::firstOrCreate(
            ['name' => 'Impact / Emotion'],
            ['category' => 'all', 'weight' => 20, 'order' => 4]
        );

        // 5. Seed Dummy Photos
        $images = [
            'https://images.unsplash.com/photo-1541888014768-45e0fb14b1cc',
            'https://images.unsplash.com/photo-1517409081512-42171120eb5a',
            'https://images.unsplash.com/photo-1542038784456-1ea8e935640e',
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9',
            'https://images.unsplash.com/photo-1516035069371-29a1b244cc32'
        ];

        foreach ($images as $index => $imageUrl) {
            Photo::firstOrCreate(
                ['sync_id' => 'row_' . ($index + 1)],
                [
                    'title' => 'Sample Photo ' . ($index + 1),
                    'story' => 'This is a sample story detailing the human interest and hard work captured in this photograph for the Kasiinfo Photo Challenge.',
                    'google_drive_link' => $imageUrl, // For dummy purposes, using unsplash as base
                    'google_drive_preview' => $imageUrl . '?q=80',
                    'google_drive_thumbnail' => $imageUrl . '?q=80',
                    'category' => $index % 2 === 0 ? 'smartphone' : 'dslr',
                    'location' => 'Tanah Grogot',
                    'taken_at' => now()->subDays(rand(1, 30)),
                    'status' => 'pending'
                ]
            );
        }
    }
}
