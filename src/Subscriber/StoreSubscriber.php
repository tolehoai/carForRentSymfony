<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StoreSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            'foo.action' => ['onFooAction'],
            'bar.action' => ['onBarAction'],
        ];
    }
    public function onFooAction()
    {
        dd('onFooAction');
    }

    public function onBarAction()
    {
        dd('onBarAction');

    }


}