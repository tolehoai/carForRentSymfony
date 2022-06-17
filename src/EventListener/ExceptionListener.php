<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $jsonResponse = new JsonResponse();
        if ($exception instanceof AccessDeniedHttpException) {
            $jsonResponse->setData(['message' => $exception->getPrevious()->getMessage()]);
            $jsonResponse->setStatusCode($exception->getPrevious()->getCode());
        } else {
            $jsonResponse->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $jsonResponse->setData(['message' => $exception->getMessage()]);
        }
        $event->setResponse($jsonResponse);
    }
}
