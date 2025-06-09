<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockmovements extends Model
{
    protected $fillable = ['id_alct', 'mvt_type', 'qty', 'from_loc', 'to_loc', 'desc'];

    public function allocations(){
        return $this->belongsTo(allocations::class, 'id_alct');
    }

    protected $primaryKey = 'id_smvt';

    protected $table = 'sct_mvt';
}
