<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primaryKey = 'activity_id';
    protected $table = 'activities';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'admin_id',
        'session_id',
        'activity_type',
        'description',
        'activity_timestamp'
    ];

    // Relationship với user và admin
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}