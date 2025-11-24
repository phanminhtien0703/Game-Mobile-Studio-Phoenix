<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'created_at',
        'last_login',
        'status',
        'last_activity',
        'last_ip'
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Override getAuthPassword để sử dụng password_hash
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relationship với activities
    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'user_id');
    }
}