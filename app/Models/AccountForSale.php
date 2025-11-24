<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountForSale extends Model
{
    use HasFactory;

    protected $table = 'accounts_for_sale';

    protected $fillable = [
        'user_id',
        'game_id',
        'character_name',
        'server_name',
        'price',
        'description',
        'images',
        'status',
        'views',
    ];

    protected $casts = [
        'images' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSold($query)
    {
        return $query->where('status', 'sold');
    }

    // Helper methods
    public function isSold()
    {
        return $this->status === 'sold';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
