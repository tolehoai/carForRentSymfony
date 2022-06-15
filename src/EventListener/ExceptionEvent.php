<?php

namespace App\EventListener;

use Symfony\Contracts\EventDispatcher\Event;

class ExceptionEvent extends Event
{
    public const SET = 'exception.set';
}