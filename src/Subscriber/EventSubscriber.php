<?php

namespace App\Subscriber;

use App\EventListener\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            'exception.set' => 'onExceptionSet',
        ];
    }

    public function onExceptionSet(ExceptionEvent $event): void
    {
       dd('Run exception');
    }
}