<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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

    // Relationship với activities
    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'user_id');
    }
}