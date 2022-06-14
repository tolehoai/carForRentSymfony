<?php

namespace App\Listener;

use Symfony\Contracts\EventDispatcher\Event;

class DemoListener
{
    public function onFooAction(Event $event)
    {
        dd('Foo Event');
    }
}