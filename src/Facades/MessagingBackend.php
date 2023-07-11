<?php
namespace Joegabdelsater\MessagingBackend\Facades;

use Illuminate\Support\Facades\Facade;

class MessagingBackend extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'messaging-backend';
    }
}