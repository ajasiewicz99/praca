<?php

namespace App\Module\Shared\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class BadRequestResponse extends JsonResponse
{
    public function __construct(array|string $content, int $status = 400, array $headers = [])
    {
        $data = ['error' => $content];

        parent::__construct($data, $status, $headers);
    }
}
