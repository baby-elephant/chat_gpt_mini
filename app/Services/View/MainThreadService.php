<?php

namespace App\Services\View;

use App\Services\DataBase\ChatsService;
use App\Models\Chat;
use App\Services\DataBase\ChatHistoriesService;
use App\Services\DataBase\ChatMessagesService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MainThreadService
{
    private ChatsService $chatsService;
    private ChatMessagesService $chatMessagesService;
    private ChatHistoriesService $chatHistoriesService;

    public function __construct(
        ChatsService $chatsService,
        ChatMessagesService $chatMessagesService,
        ChatHistoriesService $chatHistoriesService,
    ) {
        $this->chatsService = $chatsService;
        $this->chatMessagesService = $chatMessagesService;
        $this->chatHistoriesService = $chatHistoriesService;
    }

    /**
     *
     *
     * @param integer $user_id
     * @return array|null   :   Using chat_of_history.balde.php
     */
    public function getAllChatsForChatHistory(int $user_id): array {
        return $this->chatsService->getAllChatsByUserId($user_id, ['ulid', 'title']);
    }

    /**
     * Undocumented function
     *
     * @param [type] $user_id
     * @param [type] $chat_ulid
     * @return array|null
     */
    public function getChatInfos(int $user_id, string $chat_ulid): array|null {
        return $this->chatsService->getChatInfosByChatUlid(
            $user_id, $chat_ulid, ['chat_histories.id', 'parent_chat_history_id', 'role', 'content']
        );
    }

    public function getChatMessagesForApi(int $user_id, int $parent_chat_history_id): array {
        // $parent_chat_history_idから$chat_ulidを取得する.
        $chat_ulid = $this->chatHistoriesService->getTargetColumnValueById($parent_chat_history_id, 'chat_ulid');
        // 本来はここでparent_chat_history_idに紐づくpathカラムの値を取得し、
        // その値をchat_histories.id配列にしたのち、where句で絞り込んだchatInfosを取得する.
        $chat_infos = $this->getChatInfos($user_id, $chat_ulid);

        $messaageArrays = [];
        foreach($chat_infos as $chat_info) {
            $messageArray = $this->createChatMessageArray(null, $chat_info['role'], $chat_info['content'], '', '');
            $messaageArrays[] = $messageArray;
        }
        Log::info('$messaageArrays');
        Log::info(print_r($messaageArrays, true));
        return $messaageArrays;
    }

    /**
     * ユーザーのpromptを基に各種テーブルに情報を保存する.
     * 対象テーブル: chats, chat_messages, chat_histories
     * 今後functionや諸々のoptionを実装予定
     *
     * @param integer $user_id
     * @param string $chat_ulid
     * @param string $role
     * @param string $prompt
     * @param integer|null $parent_chat_history_id
     * @return array
     */
    public function saveUserPrompt(int $user_id, string $chat_ulid, string $role, string $prompt, ?int $parent_chat_history_id): array {

        try {
            if($chat_ulid === 'new')
                $chat_ulid = $this->chatsService->insertAndGetPrimaryKey($user_id, mb_substr($prompt, 0, 10));

            $messageArray = $this->createChatMessageArray($chat_ulid, $role, $prompt, null, null);

            Log::info('$messaageArray');
            Log::info(print_r($messageArray, true));

            $chat_message_id = $this->chatMessagesService->insertAndGetPrimaryKey($messageArray);

            // 今後functionや諸々のoptionを実装予定.
            $chat_history_id = $this->chatHistoriesService->insertAndGetPrimaryKey($chat_ulid, $chat_message_id, null, $parent_chat_history_id, null, null);

            // 今insertしたchat_historesのpathカラムに値を追加.
            $this->chatHistoriesService->updatePathColumn($chat_history_id, $parent_chat_history_id);

            return ['status' => 200, 'message' => '', 'values' => ['chat_ulid' => $chat_ulid, 'chat_history_id' => $chat_history_id]];

        }catch (Exception $e) {
            Log::warning($e);
            return ['status' => 500, 'message' => '', 'values' => ['chat_ulid' => 'new']];
        }
    }


    /**
     * Undocumented function
     *
     * @param string $assistant_content
     * @param integer $parent_chat_history_id
     * @return integer
     */
    public function saveAssistantContent(string $assistant_content, int $parent_chat_history_id): int {
        try {
            // $parent_chat_history_idから$chat_ulidを取得する.
            $chat_ulid = $this->chatHistoriesService->getTargetColumnValueById($parent_chat_history_id, 'chat_ulid');

            $messageArray = $this->createChatMessageArray($chat_ulid, 'assistant', $assistant_content, null, null);

            $chat_message_id = $this->chatMessagesService->insertAndGetPrimaryKey($messageArray);

            // 今後functionや諸々のoptionを実装予定.
            $chat_history_id = $this->chatHistoriesService->insertAndGetPrimaryKey($chat_ulid, $chat_message_id, null, $parent_chat_history_id, null, null);

            // 今insertしたchat_historesのpathカラムに値を追加.
            $this->chatHistoriesService->updatePathColumn($chat_history_id, $parent_chat_history_id);

            return $chat_history_id;

        }catch (Exception $e) {
            Log::warning($e);
            return ['status' => 500, 'message' => '', 'values' => ['chat_ulid' => 'new']];
        }
    }

    /**
     * Undocumented function
     *
     * @param string|null $chat_ulid :  null=> for API
     * @param string $role
     * @param string $content
     * @param string|null $name
     * @param string|null $function_call
     * @return array
     */
    private function createChatMessageArray(
        ?string $chat_ulid, string $role, string $content, ?string $name, ?string $function_call
    ) : array {

        if(is_null($chat_ulid)){
            return ['role' => $role, 'content' => $content/**, 'name' => $name, 'function_call' => $function_call */];
        }else {
            return ['chat_ulid' => $chat_ulid, 'role' => $role, 'content' => $content, 'name' => $name, 'function_call' => $function_call];
        }
    }

    public function deleteRelatedChatUlidRecode(string $chat_ulid) {
        $this->chatsService->deleteChatsRecode($chat_ulid);
    }
}
