<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStatus extends Model
{
    use HasFactory;

    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'game_status';

    /**
     * Khóa chính của bảng
     *
     * @var string
     */
    protected $primaryKey = 'status_id';
    public $timestamps = false;

    /**
     * Các trường có thể được gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'status_name',
    ];

    /**
     * Mối quan hệ với bảng games
     */
    public function games()
    {
        return $this->hasMany(Game::class, 'status_id', 'status_id');
    }

    /**
     * Scope để lọc các trạng thái theo tên trạng thái
     */
    public function scopeByStatusName($query, $statusName)
    {
        return $query->where('status_name', $statusName);
    }

    /**
     * Kiểm tra xem trạng thái có phải là một trạng thái cụ thể không
     */
    public function isStatusName($statusName)
    {
        return $this->status_name === $statusName;
    }
}