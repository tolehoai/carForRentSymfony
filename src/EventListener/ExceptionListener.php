<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Throwable;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ExceptionListener
{
    const DEFAULT_ERROR_MESSAGE = 'Something wrong.';
    const DEFAULT_ERROR_TEMPLATE = 'error/index.html.twig';
    const DEV_ENV = 'dev';
    const API_CONTROLLER_PREFIX = 'App\Controller\Api';

    private string $environment;
    private ?Request $request;
    private Environment $twig;

    /**
     * @param KernelInterface $kernel
     * @param RequestStack $requestStack
     * @param Environment $twig
     */
    public function __construct(KernelInterface $kernel, RequestStack $requestStack, Environment $twig)
    {
        $this->environment = $kernel->getEnvironment();
        $this->request = $requestStack->getCurrentRequest();
        $this->twig = $twig;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        [$statusCode, $message] = $this->getStatusCodeAndMessage($exception);
        if ($this->isApiRequest()) {
            $response = new JsonResponse();
            $content = $this->getApiContent($statusCode, $message);
        } else {
            $response = new Response();
            $content = $this->getRenderContent($statusCode, $message);
        }
        $response->setStatusCode($statusCode);
        $response->setContent($content);
        $event->setResponse($response);
    }

    /**
     * @param Throwable $exception
     * @return void
     */
    private function getStatusCodeAndMessage(Throwable $exception): array
    {
        $exceptionClass = get_class($exception);
        $message = $this->isDevEnvironment() ? $exception->getMessage() : static::DEFAULT_ERROR_MESSAGE;
        switch ($exceptionClass) {
            case HttpExceptionInterface::class:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
            case NotFoundHttpException::class:
                $statusCode = Response::HTTP_NOT_FOUND;
                break;
            default:
                $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return [$statusCode, $message];
    }

    /**
     * @return bool
     */
    private function isDevEnvironment(): bool
    {
        return $this->environment === static::DEV_ENV;
    }

    /**
     * @return bool
     */
    private function isApiRequest(): bool
    {
        $prefix = static::API_CONTROLLER_PREFIX;
        $controller = $this->request->attributes->get('_controller');

        return substr($controller, 0, strlen($prefix)) === $prefix;
    }

    /**
     * @param int $statusCode
     * @param string $message
     * @return string
     */
    private function getApiContent(int $statusCode, string $message): string
    {
        $data = [
            'code' => $statusCode,
            'error' => true,
            'status' => 'error',
            'message' => $message
        ];

        return json_encode($data);
    }

    /**
     * @param int $statusCode
     * @param string $message
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function getRenderContent(int $statusCode, string $message): string
    {
        $options = ['errorCode' => $statusCode, 'errorMessage' => $message];

        return $this->twig->render(static::DEFAULT_ERROR_TEMPLATE, $options);
    }
}
