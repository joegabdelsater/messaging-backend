<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{   
    use HasFactory;

    protected $fillable = ['sender_id', 'message'];

    /**
     * Get the sender that owns the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function chat() {
        return $this->belongsTo(Chat::class);
    }
    

    
}
