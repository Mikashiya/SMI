<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'role', 'action', 'target', 'description', 'ip_address', 'user_agent'];

    public static function record($userId, $role, $action, $target = null, $description = null)
    {
        self::create([
            'user_id'     => $userId,
            'role'        => $role,
            'action'      => $action,
            'target'      => $target,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}
