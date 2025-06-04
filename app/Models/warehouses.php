<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warehouses extends Model
{
    protected $fillable =['wh_type', 'shelf_count', 'shelf_ids', 'cabs_count', 'cabs_ids', 'capacity', 'temp_ctrl', 'id_whlocs'];

    protected $primaryKey = 'id_wh';

    public function allocations(){
        return $this->hasMany(allocations::class);
    }

    public function whlocs(){
        return $this->belongsTo(wh_locs::class, 'id_whlocs');
    }
    protected $table = 'warehouses';
}
