<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class CustomUser extends Authenticatable
{
    protected $table = 'custom_users';

    protected $fillable = [
        'username',
        'password',
        'id_role', // Assuming you have a role field
    ];

    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'id';

    public function role()
    {
        return $this->belongsTo(CustomRole::class, 'id_role', 'id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'id');
    }

    public function stc_mvt()
    {
        return $this->hasMany(stockmovements::class, 'user_id', 'user_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function isLeader()
    {
        return $this->role && $this->role->role_name === 'Leader';
    }

    public function isStaff()
    {
        return $this->role && $this->role->role_name === 'Staff';
    }
}
