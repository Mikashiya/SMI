<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


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

    public function isLeader()
    {
        return $this->role && $this->role->role_name === 'leader';
    }

    public function isUser()
    {
        return $this->role && $this->role->role_name === 'user';
    }
}
