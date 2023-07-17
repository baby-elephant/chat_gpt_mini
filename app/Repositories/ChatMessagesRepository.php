<?php

namespace App\Repositories;

use App\Models\ChatMessage;

class ChatMessagesRepository
{
    public function insert(array $messageArray) {
        return ChatMessage::create($messageArray);
    }
}
