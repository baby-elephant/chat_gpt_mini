<?php

namespace App\Repositories;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatsRepository
{

    // 後で引数とか修正する
    public function insert(array $inserted_array) {
        return Chat::create($inserted_array);
    }

    public function delete(string $chat_ulid) {
        return Chat::find($chat_ulid)->delete();
    }

    public function getAllChatsByUserId(int $user_id, array $target_columns) {
        return Chat::query()
            ->select($target_columns)
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getChatInfoByConditions(array $target_columns, array $conditions) {
        $chat = Chat::where($conditions)->first();

        return is_null($chat) ?
            null :
            $chat
            ->chatHistories()
            ->select($target_columns)
            ->leftjoin('chat_messages', 'chat_message_id', 'chat_messages.id')
            ->getResults();
    }
}
