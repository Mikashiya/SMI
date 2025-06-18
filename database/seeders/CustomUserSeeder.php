<?php

namespace Database\Seeders;

use App\Models\CustomUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => '00649', 'password' => 'test123', 'id_role' => 1],
            ['username' => '00650', 'password' => 'test120', 'id_role' => 2],
            ['username' => '00651', 'password' => 'test121', 'id_role' => 2],
        ];

        foreach ($users as $user) {
            CustomUser::create($user); // Mutator akan hash password otomatis
        }
        // Note: Passwords should be hashed in a real application
        // You can use Hash::make('test123') to hash the passwords before inserting
        // Example: DB::table('users')->insert(['username' => '00649', 'password' => Hash::make('test123'), 'id_role' => 1]);
        // If you want to use the CustomUser model, you can do it like this:
        // \App\Models\CustomUser::create([
        //     'username' => '00649',
        //     'password' => bcrypt('test123'), // Use bcrypt for hashing
        //     'id_role' => 1,
        // ]);
        // You can also use the CustomUser model to create users
        // \App\Models\CustomUser::create([
        //     'username' => '00650',
        //     'password' => bcrypt('test123'),
        //     'id_role' => 2,
        // ]);
    }
}
