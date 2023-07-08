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
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->id()->comment('チャットごとのチャット履歴を一意に識別するID');
            $table->foreignUlid('chat_ulid')->comment('チャットを一意に識別するID');
            $table->unsignedBigInteger('chat_message_id')->comment('チャットメッセージを一意に識別するID');
            $table->unsignedBigInteger('chat_function_id')->nullable()->comment('チャットファンクションを一意に識別するID');
            $table->text('function_call')->nullable()->comment('チャットファンクション呼び出しに対してモデルがどのように応答するかを制御します:[none, auto, 特定の関数(JSON)] 関数呼び出しに対してモデルがどのように応答するかを制御します。"none "はモデルが関数を呼び出さず、エンドユーザーに応答することを意味します。"auto "は、モデルがエンドユーザーか関数を呼び出すかを選択できることを意味します。特定の関数を{"name": \ "my_function"}で指定すると、モデルはその関数を呼び出します。"none "は、関数が存在しない場合のデフォルトです。「auto "は、関数が存在する場合のデフォルトです。');
            $table->integer('temperature')->nullable()->comment('チャットのランダム性を表す値:0.0~2.0: 使用するサンプリング温度は0から2の間。0.8のような高い値は出力をよりランダムにし、0.2のような低い値は出力をより集中して決定論的にする。一般的には、この値かtop_pを変更することを推奨しますが、両方は推奨しません。');
            $table->integer('top_p')->nullable()->comment('チャットの自由度を指定する百分率値:核サンプリングと呼ばれる温度によるサンプリングの代替案では、top_p個の確率質量を持つトークンの結果を考慮する。つまり、0.1は上位10%の確率を持つトークンのみを考慮することを意味する。私たちは一般的に、これかtemperatureを変更することを推奨しますが、両方は推奨しません。');
            $table->integer('n')->nullable()->comment('各入力メッセージに対していくつのチャット補完選択肢を生成するか');
            $table->integer('max_tokens')->nullable()->comment('チャット完了時に生成するトークンの最大数:入力トークンと生成されるトークンの合計の長さは、モデルのコンテキストの長さによって制限されます。');
            $table->integer('presence_penalty')->nullable()->comment('以前と似た内容に対するペナルティ値:-2.0~2.0 の間の数値。正の値は、新しいトークンがこれまでにテキストに現れたかどうかに基づいてペナルティを課し、モデルが新しいトピックについて話す可能性を高める。');
            $table->integer('frequency_penalty')->nullable()->comment('繰り返しに対するペナルティ値:-2.0~2.0の間の数値。正の値は、新しいトークンに、これまでのテキストにおける既存の頻度に基づいてペナルティを与え、モデルが同じ行を逐語的に繰り返す可能性を低下させる。');
            $table->text('logit_bias')->nullable()->comment('トークンの出現確率を指定するJSONオブジェクト:JSON 例：{96096:20} (トークナイザーのトークン ID で指定) を -100 から 100 までのバイアス値にマップする json オブジェクトを受け取ります。数学的には、バイアスはサンプリングの前にモデルによって生成されたロジットに追加されます。正確な効果はモデルによって異なりますが、-1から1の間の値は、選択の可能性を減少または増加させるはずです。');
            $table->unsignedBigInteger('parent_chat_history_id')->nullable()->comment('親のチャット履歴を一意に識別するID:分岐点を表す。');
            $table->text('path')->nullable()->comment('ここまでのチャットの履歴を表す[/]区切りの文字列');

            $table->foreign('chat_ulid')->references('ulid')->on('chats')->onDelete('CASCADE');
            $table->foreign('chat_message_id')->references('id')->on('chat_messages')->onDelete('CASCADE');
            $table->foreign('chat_function_id')->references('id')->on('chat_functions')->onDelete('CASCADE');
            $table->foreign('parent_chat_history_id')->references('id')->on('chat_histories')->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_histories');
    }
};
