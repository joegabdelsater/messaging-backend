<?php

namespace Joegabdelsater\MessagingBackend;

use App\Models\ChatMessage;
use App\Models\Chat;

class MessagingService
{

    public static function getUserChats($user_id)
    {
        $chats = Chat::with('messages', 'professional', 'user')->where('professional_id', $user_id)->orWhere('user_id', $user_id)->get();

        $chats = $chats->map(function ($chat) use ($user_id) {
            $has_unread_messages = $chat->messages->filter(function ($message) use ($user_id) {
                return !$message->is_read && $message->sender_id !== $user_id;
            })->first() ? true : false;

            $chat['has_unread_messages'] = $has_unread_messages;
            return $chat;
        });

        return $chats;
    }

    public static function create($professional_id, $user_id)
    {
        return  Chat::firstOrCreate([
            'professional_id' => $professional_id,
            'user_id' => $user_id,
        ]);
    }

    public static function getById($id, $user_id)
    {
        $chat = Chat::with('professional', 'user', 'messages')->find($id);
        if($chat) {
            ChatMessage::where([
                'chat_id' => $id,
                ['sender_id', '!=', $user_id],
                'is_read' => false,
            ])->update(['is_read' => true]);
        }
        return $chat;
    }

    public static function getByUsers($professional_id, $user_id)
    {
        $chat = Chat::with('professional', 'user', 'messages')->where('professional_id', $professional_id)->where('user_id', $user_id)->first();
        return $chat;
    }

    public static function createMessageByChatId($chat_id, $message, $sender_id)
    {
        ChatMessage::create([
            'chat_id' => $chat_id,
            'message' => $message,
            'sender_id' => $sender_id,
        ]);

        return self::getById($chat_id, $sender_id);
    }

    public static function createMessageByUserIds($professional_id, $user_id, $sender_id, $message)
    {
        $chat = self::getByUsers($professional_id, $user_id);

        if (!$chat) {
            return $chat;
        }

        return self::createMessageByChatId($chat->id, $message, $sender_id);
    }
}
