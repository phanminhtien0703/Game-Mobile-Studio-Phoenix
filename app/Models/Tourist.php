<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    protected $primaryKey = 'tourist_id';
    protected $table = 'tourists';
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip_address',
        'activity_type',
        'description',
        'activity_timestamp'
    ];
}