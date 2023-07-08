<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;
    use HasUlids;

    protected $guarded = ['ulid', 'created_at'];
    protected $primaryKey = 'ulid';

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chatHistories(): HasMany {
        return $this->hasMany(ChatHistory::class, 'chat_ulid');
    }
    public function chatMessages(): HasMany {
        return $this->hasMany(ChatMessage::class, 'chat_ulid');
    }

}
