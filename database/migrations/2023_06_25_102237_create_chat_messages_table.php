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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id()->comment('チャットメッセージを一意に識別するID');
            $table->foreignUlid('chat_ulid')->comment('チャットを一意に識別するID');
            $table->string('role', 9)->comment('チャットメッセージの作成者の役割:[system, user, assistant]');
            $table->text('content')->comment('チャットメッセージのコンテキスト');
            $table->string('name')->nullable()->comment('チャットメッセージの作成者の名前');
            $table->text('function_call')->nullable()->comment('チャットファンクションの関数名と引数を指定するJSONオブジェクト:JSON');

            $table->foreign('chat_ulid')->references('ulid')->on('chats')->onDelete('CASCADE');
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
