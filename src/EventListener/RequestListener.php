<?php

namespace App\EventListener;

use App\Service\RequestTransformer;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class RequestListener
{
    private RequestTransformer $requestTransformer;

    public function __construct(RequestTransformer $requestTransformer)
    {
        $this->requestTransformer = $requestTransformer;
    }

    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if($request->getContentTypeFormat() !== 'json') {
            return;
        }

        $transformJsonDataSuccess = $this->requestTransformer->transformJsonRequest($request);

        if(!$transformJsonDataSuccess) {
            $response = new JsonResponse([
                "message" => "Invalid JSON"
            ],
                Response::HTTP_BAD_REQUEST
            );

            $event->setResponse($response);
        }
    }
}
