<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Events\MessageSent;

class ChatController extends Controller
{
    // 1. Khách gửi tin
    public function guestSend(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'required' // UUID từ LocalStorage của khách
        ]);

        // Tìm hoặc tạo phiên chat mới
        $session = ChatSession::firstOrCreate(
            ['id' => $request->session_id],
            ['name' => 'Khách mới'] // Có thể cập nhật tên sau
        );

        // Lưu tin nhắn
        $msg = $session->messages()->create([
            'message' => $request->message,
            'is_admin' => false,
        ]);

        // Bắn sự kiện Real-time
        broadcast(new MessageSent($msg))->toOthers();

        return response()->json(['status' => 'success', 'data' => $msg]);
    }

    // 2. Admin gửi tin (Trả lời)
    public function adminReply(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'session_id' => 'required|exists:chat_sessions,id'
        ]);

        $msg = ChatMessage::create([
            'chat_session_id' => $request->session_id,
            'message' => $request->message,
            'is_admin' => true, // Đánh dấu là Admin
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        return response()->json(['status' => 'success', 'data' => $msg]);
    }

    // 3. Lấy lịch sử chat (Load vào giao diện)
    public function getMessages($sessionId)
    {
        return ChatMessage::where('chat_session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getSessions()
    {
        // Lấy danh sách các phiên chat, sắp xếp theo tin nhắn mới nhất
        $sessions = \App\Models\ChatSession::whereHas('messages')
            ->with([
                'messages' => function ($q) {
                    $q->latest()->limit(1); // Lấy tin nhắn cuối cùng để hiển thị preview
                }
            ])
            ->get()
            ->sortByDesc(function ($session) {
                return $session->messages->first()->created_at;
            })
            ->values();

        return response()->json($sessions);
    }
}
