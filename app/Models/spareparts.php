<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spareparts extends Model
{
    use HasFactory;

    protected $fillable=['part_name', 'part_type', 'mfg', 'price', 'id_spl'];

    protected $primaryKey = 'id_part';

    public function allocations(){
        return $this->hasMany(allocations::class);
    }

    public function supplier(){
        return $this->belongsTo(suppliers::class, 'id_spl');
    }

    protected $table = 'spareparts';
}
