<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatFunction extends Model
{
    use HasFactory;

    public function chatMessage(): HasMany {
        return $this->hasMany(ChatHistory::class);
    }
}
