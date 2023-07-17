<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\ChatHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatHistoriesRepository
{

    /**
     * Insert only.
     * If you want to process the instance or get the value of a certain column,
     * you must implement it in the service class.
     *
     * @param [type] $chat_history_array
     * @return object
     */
    public function insert($chat_history_array): object {
        return ChatHistory::create($chat_history_array);
    }

    public function update(array $update_array, array $where_array) {
        return ChatHistory::query()->where($where_array)->update($update_array);
    }

    /**
     * Get a Model.
     * Narrowed down by $conditions.
     * Returned Model's values is selected by $target_columns.
     *
     * @param array $target_columns :   using in select-method
     * @param array $conditions :   using in where-method
     * @return Model|static|null :   selected by $target_columns
     */
    public function getRecodeByConditions(array $target_columns, array $conditions): Model|static|null {
        return ChatHistory::query()
        ->select($target_columns)
        ->where($conditions)
        ->first();
    }
}
