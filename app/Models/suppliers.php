<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    protected $fillable = ['id_spl', 'spl_name', 'ctc_info'];

    protected $primaryKey = 'id_spl';

    protected $table = 'supplier';

    public function spareparts(){
        return $this->hasMany(spareparts::class);
    }
}
