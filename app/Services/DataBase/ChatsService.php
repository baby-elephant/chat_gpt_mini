<?php

namespace App\Services\DataBase;

use App\Models\Chat;
use App\Repositories\ChatsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatsService

{

    private ChatsRepository $chatRepository;

    public function __construct(
        ChatsRepository $chatRepository,
    )
    {
        $this->chatRepository = $chatRepository;
    }

    /**
     * user_idのみインサートしてそのキーを返却する
     *
     * @return string　挿入したレコードの[id]カラムの値
     */
    public function insertAndGetPrimaryKey(int $user_id, string $title): string {
        return $this->chatRepository->insert(compact('user_id', 'title'))->ulid;
    }

    public function deleteChatsRecode(string $chat_ulid) {
        return $this->chatRepository->delete($chat_ulid);
    }

    /**
     * Undocumented function
     *
     * @param integer $user_id
     * @param array $target_columns
     * @return array
     */
    public function getAllChatsByUserId(int $user_id, array $target_columns): array {
        return $this->chatRepository->getAllChatsByUserId($user_id, $target_columns)->toArray();
    }

    /**
     * Undocumented function
     *
     * @param integer $user_id
     * @param [type] $ulid
     * @param array $target_columns
     * @return array|null
     */
    public function getChatInfosByChatUlid(int $user_id, string $ulid/**chat_ulid */, array $target_columns): array|null {
        // user_id, chat_ulidで絞り込んだ値で取得
        $chatInfos = $this->chatRepository->getChatInfoByConditions($target_columns, compact('user_id', 'ulid'));
        return is_null($chatInfos) ? null : $chatInfos->toArray();
    }
}
