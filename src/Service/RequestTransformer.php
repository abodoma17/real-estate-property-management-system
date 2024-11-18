<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class RequestTransformer
{
    public function transformJsonRequest(Request $request): bool
    {
        if (empty($request->getContent())) {
            return true;
        }

        $decodedData = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        $request->request->replace($decodedData);

        return true;
    }

}