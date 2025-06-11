<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{
    protected $table = 'custom_roles';

    protected $fillable = [
        'role_name',
        'description',
        'is_active',
    ];

    public function user()
    {
        return $this->hasMany(CustomUser::class);
    }
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key in your custom_roles table
}
