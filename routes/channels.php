<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// // Cho phép bất kỳ ai có session ID đúng đều được nghe kênh này
// Broadcast::channel('chat.{sessionId}', function ($user, $sessionId) {
//     return true; // Luôn trả về true để Guest cũng nghe được
// });
