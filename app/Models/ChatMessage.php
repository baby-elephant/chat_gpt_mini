<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatMessage extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function chat(): BelongsTo {
        return $this->belongsTo(Chat::class);
    }

    public function chatHistories(): HasMany {
        return $this->hasMany(ChatHistory::class, 'chat_ulid');
    }

}
