<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockmovements extends Model
{
    protected $fillable = ['id_alct', 'mvt_type', 'qty', 'from_loc', 'to_loc', 'desc', 'pic_wh', 'pic_item', 'price', 'supplier', 'part_use', 'date_in', 'date_out', 'date_transfer'];

    public function allocations(){
        return $this->belongsTo(allocations::class, 'id_alct');
    }

    protected $primaryKey = 'id_smvt';

    protected $table = 'stc_mvt';

    public function getWarehouseIdAttribute()
    {
        return $this->allocations?->warehouses?->id_whlocs;
    }

}
