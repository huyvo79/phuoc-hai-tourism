<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Nhớ thêm dòng này để dùng UUID

class ChatSession extends Model
{
    use HasUuids; // Tự động tạo UUID khi create

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'email', 'is_active'];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
