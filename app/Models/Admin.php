<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'created_at',
        'last_login',
        'role',
        'last_activity',
        'last_ip'
    ];

    // Relationship với activities
    public function activities()
    {
        return $this->hasMany(Activity::class, 'admin_id', 'admin_id');
    }
}