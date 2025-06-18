<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockmovements extends Model
{
    protected $fillable = ['id_alct', 'mvt_type', 'qty', 'from_loc', 'to_loc', 'description', 'pic_wh', 'pic_item', 'price', 'supplier', 'part_use', 'date_in', 'date_out', 'date_transfer', 'user_id'];

    public function allocations(){
        return $this->belongsTo(allocations::class, 'id_alct');
    }

    public function custom_users(){
        return $this->belongsTo(CustomUser::class, 'user_id');
    }

    protected $primaryKey = 'id_smvt';

    protected $table = 'stc_mvt';

    public function getWarehouseIdAttribute()
    {
        return $this->allocations?->warehouses?->id_whlocs;
    }

}
