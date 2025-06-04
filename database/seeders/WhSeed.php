<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
            ['wh_type'=>'Mechanic', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'1'],
            ['wh_type'=>'Electric', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'1'],
            
            ['wh_type'=>'Mechanic', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'2'],
            ['wh_type'=>'Electric', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'2'],
            
            ['wh_type'=>'Mechanic', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'3'],
            ['wh_type'=>'Electric', 'shelf_count'=>'5', 'shelf_ids'=>'A-3', 'cabs_count'=>'5', 'cabs_ids'=>'A-3', 'capacity'=>'200', 'temp_ctrl'=>'Normal', 'id_whlocs'=>'3'],
        ]);
    }
}
