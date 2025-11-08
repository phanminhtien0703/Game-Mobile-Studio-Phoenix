<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Game extends Model
{
    use HasFactory;

    protected $primaryKey = 'game_id';
    
    protected $keyType = 'string';
    
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'game_name',
        'genre',
        'description',
        'release_date',
        'avatar_url',
        'banner_url',
        'download_link',
        'status_id'
    ];

    protected $dates = [
        'release_date',
        'last_updated'
    ];

    protected static function boot()
    {
        parent::boot();

        // Tự động set last_updated khi tạo mới
        static::creating(function ($model) {
            $model->last_updated = Carbon::now('Asia/Ho_Chi_Minh');
        });

        // Tự động set last_updated khi cập nhật
        static::updating(function ($model) {
            $model->last_updated = Carbon::now('Asia/Ho_Chi_Minh');
        });
    }

    public function game_status()
    {
        return $this->belongsTo(GameStatus::class, 'status_id', 'status_id'); // Sử dụng đúng khóa ngoại và khóa chính
    }
}
