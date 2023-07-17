<?php

namespace App\Services\DataBase;

use App\Repositories\ChatHistoriesRepository;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class ChatHistoriesService
{
    private ChatHistoriesRepository $chatHistoriesRepository;

    public function __construct
    (
        ChatHistoriesRepository $chatHistoriesRepository
    )
    {
        $this->chatHistoriesRepository = $chatHistoriesRepository;
    }

    /**
     * Narrowed down by $conditions.
     * Returned Model's values is selected by $target_columns.
     *
     * @param integer $id
     * @param string $target_column
     * @return string|integer|Date
     */
    public function getTargetColumnValueById(int $id, string $target_column): string|int|Date {
        return $this->chatHistoriesRepository->getRecodeByConditions([$target_column], compact('id'))->$target_column;
    }

    /**
     * insert recode and get the recode's id column value.
     *
     * @param string $chat_ulid
     * @param integer $chat_message_id
     * @param integer|null $chat_function_id
     * @param integer|null $parent_chat_history_id
     * @param string|null $path
     * @param array|null $options   下の値の入った連想配列:
     * temparature	top_p	n	max_tokens	presence_penalty	frequency_penalty	logit_bias
     * @return integer
     */
    public function insertAndGetPrimaryKey(string $chat_ulid, int $chat_message_id, ?int $chat_function_id, ?int $parent_chat_history_id, ?string $path, ?array $options): int {
        $insert_array = ['chat_ulid' => $chat_ulid, 'chat_message_id' => $chat_message_id, 'chat_function_id' => $chat_function_id, 'path' => $path];
        if( !empty($parent_chat_history_id) )
            $insert_array['parent_chat_history_id'] = $parent_chat_history_id;
        if(!is_null($options))
            $insert_array = array_merge($insert_array, $options);

        return $this->chatHistoriesRepository->insert($insert_array)->id;
    }

    /**
     * Update path-column value.
     *
     * @param integer $inserted_chat_history_id
     * @param integer|null $parent_chat_history_id
     * @return void
     */
    public function updatePathColumn(int $inserted_chat_history_id, ?int $parent_chat_history_id) {
        $path = '';
        if(isset($parent_chat_history_id))
            $path = $this->getTargetColumnValueById($parent_chat_history_id, 'path');
        $path = "$path/" . strval($inserted_chat_history_id);
        return $this->chatHistoriesRepository->update(compact('path'), ['id' => $inserted_chat_history_id]);
    }
}
