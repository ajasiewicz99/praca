<?php namespace App\Module\Shared\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class NotFoundResponse extends JsonResponse
{
    public function __construct(string|array $content, int $status = 404, array $headers = [])
    {
        $data = ['error' => $content];

        parent::__construct($data, $status, $headers);
    }
}
