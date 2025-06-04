<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wh_locs extends Model
{
    protected $fillable =['location', 'manager', 'ctc_info'];

    protected $primaryKey = 'id_whlocs';

    public function warehouses(){
        return $this->hasMany(warehouses::class);
    }

    protected $table = 'whlocs';

}
