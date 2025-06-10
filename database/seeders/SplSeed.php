<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SplSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier')->insert([
            ['spl_name'=>'Robot 1', 'ctc_info'=>'Test 1'],
            ['spl_name'=>'Robot 2', 'ctc_info'=>'Test 2'],
            ['spl_name'=>'Robot 3', 'ctc_info'=>'Test 3'],
        ]);
    }
}
