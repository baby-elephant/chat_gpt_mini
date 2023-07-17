<?php

namespace App\Services\DataBase;

use App\Models\ChatMessage;
use App\Repositories\ChatMessagesRepository;
use Illuminate\Support\Facades\Hash;

class ChatMessagesService
{
    private ChatMessagesRepository $chatMessagesRepository;

    public function __construct
    (
        ChatMessagesRepository $chatMessagesRepository
    )
    {
        $this->chatMessagesRepository = $chatMessagesRepository;
    }


    /**
     * インサートしてそのキーを返却する
     *
     * @param array $messageArray   モデルのcreate()の引数に使用する.
     * @return integer
     */
    public function insertAndGetPrimaryKey(array $messageArray): int {
        return $this->chatMessagesRepository->insert($messageArray)->id;
    }
}
