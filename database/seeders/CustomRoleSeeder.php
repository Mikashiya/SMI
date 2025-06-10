<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert custom roles into the 'custom_roles' table
        DB::table('custom_roles')->insert([
            ['role_name' => 'leader', 'description' => 'Has full access to all features and settings.', 'is_active' => true],
            ['role_name' => 'user', 'description' => 'Can edit content but has limited access to settings.', 'is_active' => true],
        ]);
    }
}
