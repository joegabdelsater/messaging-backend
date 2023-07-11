<?php

namespace Joegabdelsater\MessagingBackend;
use App\Models\ChatMessage;
use App\Models\Chat;

class MessagingService
{

    public static function create($professional_id, $user_id) {
      return  Chat::firstOrCreate([
            'professional_id' => $professional_id,
            'user_id' => $user_id,
        ]);
    }

    public static function getById($id) {
        return Chat::with('professional','user', 'messages' )->find($id);
    }

    public static function getByUsers($professional_id, $user_id) {
        return Chat::with('professional','user', 'messages' )->where('professional_id', $professional_id)->where('user_id', $user_id)->first();
    }

    public static function createMessageByChatId($chat_id, $message, $sender_id) {
        ChatMessage::create([
            'chat_id' => $chat_id,
            'message' => $message,
            'sender_id' => $sender_id,
        ]);

        return self::getById($chat_id);
    }

    public static function createMessageByUserIds($professional_id, $user_id, $sender_id, $message) {
        $chat = self::getByUsers($professional_id, $user_id);

        if(!$chat) {
            return $chat;
        }

        return self::createMessageByChatId($chat->id, $message, $sender_id);  
    }

}
