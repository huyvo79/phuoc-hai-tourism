<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('chat_session_id')->constrained('chat_sessions')->onDelete('cascade');
            $table->text('message');
            $table->boolean('is_admin')->default(false); // false = Khách, true = Admin
            $table->timestamp('read_at')->nullable(); // Để đánh dấu đã xem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
