<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compose_email', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('cc_email')->nullable(); // tiêu đề email
            $table->string('subject')->nullable(); // tiêu đề email
            $table->string('description')->nullable(); // email người nhận
            $table->timestamp('sent_at')->nullable(); // thời gian gửi email (có thể null nếu chưa gửi)
            $table->timestamps(); // các trường created_at v
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compose_email');
    }
};