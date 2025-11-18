<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $primaryKey = 'discount_id';

    public $timestamps = false;  // Tắt timestamps vì bảng không có updated_at

    protected $fillable = [
        'game_id',
        'event_name',
        'banner_url',
        'event_link',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationship with Game
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }
}
