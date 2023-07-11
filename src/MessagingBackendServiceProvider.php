<?php

namespace Joegabdelsater\MessagingBackend;

use Illuminate\Support\ServiceProvider;

class MessagingBackendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('messaging-backend', function () {
            return new MessagingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom([
            __DIR__.'/Migrations/2023_05_05_084354_create_chats_table.php',
            __DIR__.'/Migrations/2023_05_05_084355_create_chat_messages_table.php',
        ]);

        $this->publishes([
            __DIR__.'/Requests/ChatRequest.php' => app_path('Http/Requests/ChatRequest.php'),
            __DIR__.'/Requests/ChatMessageRequest.php' => app_path('Http/Requests/ChatMessageRequest.php'),
            __DIR__.'/Models/Chat.php' => app_path('Models/Chat.php'),
            __DIR__.'/Models/ChatMessage.php' => app_path('Models/ChatMessage.php'),
        ], 'promo-codes-models');
    }
}
