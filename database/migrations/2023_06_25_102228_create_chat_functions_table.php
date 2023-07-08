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
        Schema::create('chat_functions', function (Blueprint $table) {
            $table->id()->comment('チャットファンクションを一意に識別するID');
            $table->string('name')->comment('チャットファンクション名');
            $table->string('description')->comment('チャットファンクションの説明');
            $table->text('parameters')->comment('チャットファンクションのパラメータを指定するJSONオブジェクト:JSON');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_functions');
    }
};
