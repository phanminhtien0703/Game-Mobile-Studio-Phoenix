<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giftcode extends Model
{
    use HasFactory;

    protected $table = 'giftcodes';
    protected $primaryKey = 'giftcode_id';
    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'message',
        'total_quantity',
        'used_quantity',
        'logo_game_url'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationship with Game
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    // Accessor for remaining quantity
    public function getRemainingQuantityAttribute()
    {
        return $this->total_quantity - $this->used_quantity;
    }

    // Accessor for usage percentage
    public function getUsagePercentageAttribute()
    {
        if ($this->total_quantity == 0) {
            return 0;
        }
        return round(($this->used_quantity / $this->total_quantity) * 100, 2);
    }
}
