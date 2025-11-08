<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';

    protected $primaryKey = 'discount_id';

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'event_name',
        'banner_url',
        'event_link',
        'start_date',
        'end_date',
        'created_at'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at'
    ];

    // Relationship with Game
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }
}
