<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function chat(): BelongsTo {
        return $this->belongsTo(Chat::class);
    }

    public function chatMessage(): BelongsTo {
        return $this->belongsTo(ChatMessage::class);
    }

    public function chatFunction(): BelongsTo {
        return $this->belongsTo(ChatFunction::class);
    }
}
