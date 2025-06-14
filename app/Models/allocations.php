<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;

class allocations extends Model
{
    protected $fillable = ['id_alct', 'usage', 'f_stock', 'e_stock', 's_stock', 'note', 'reminder', 'id_part', 'id_wh'];

    public function spareparts(){
        return $this->belongsTo(spareparts::class, 'id_part');
    }

    public function warehouses(){
        return $this->belongsTo(warehouses::class, 'id_wh');
    }
    
    protected $primaryKey = 'id_alct'; // Pastikan ini ada!
    public $incrementing = false; // Matikan auto-increment jika PK bukan angka
    protected $keyType = 'string';

    protected $table = 'allocations';

    public function stc_mvt(){
        return $this->hasMany(stockmovements::class , 'id_alct', 'id_alct');
    }
}
