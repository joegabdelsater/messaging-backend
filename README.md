# Promo Codes Description
This is a simple package to add a messaging feature to any project. It works independently from other features.

Note: You should have the users model/table present.

# Installation
`composer require joegabdelsater/messaging-backend`
`php artisan vendor:publish` to publish models
`php artisan migrate` to run the migrations

# Usage
To use the library you need to use the facade in your code by adding this line to the top of the file:

`use Joegabdelsater\PromoCodes\Facades\MessagingBackend;`

# Functions

## Create chat
`create($user_1_id, $user_2_id)`

## Get Chat by Id
`getById($chatId)`

## Get Chat by user ids
`getByUsers($user_1_id, $user_2_id)`

## Create Message Using Chat Id
`createMessageByChatId($chat_id, $message, $sender_id)`

## Create Message Using User Ids
`createMessageByUserIds($user_1_id, $user_2_id, $sender_id, $message)`
