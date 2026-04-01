<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // Quan trọng
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Kế thừa ShouldBroadcast để Laravel biết cần gửi qua WebSocket
class MessageSent implements ShouldBroadcast 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        // Gửi vào kênh riêng của phiên chat đó (ví dụ: chat.uuid-cua-khach)
        return [
            new Channel('chat.' . $this->message->chat_session_id),
        ];
    }
    
    // Dữ liệu gửi đi
    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'is_admin' => $this->message->is_admin,
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }
}
