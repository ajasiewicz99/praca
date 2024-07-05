<?php

namespace App\Module\Shared\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(array|string $content, int $status = 500, array $headers = [])
    {
        $data = ['error' => $content];

        parent::__construct($data, $status, $headers);
    }
}
