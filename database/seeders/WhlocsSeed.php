<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhlocsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('whlocs')->insert([
            ['location'=>'Plant 1', 'manager'=>'Eli', 'ctc_info'=>'Test 1'],
            ['location'=>'Plant 2', 'manager'=>'Erika', 'ctc_info'=>'Test 2'],
            ['location'=>'Plant 3', 'manager'=>'Zaizafun', 'ctc_info'=>'Test 3'],
        ]);
    }
}
