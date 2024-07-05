<?php
namespace App\Module\Shared\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class OkResponse extends JsonResponse
{
    public function __construct(array $content, int $status = 200, array $headers = [])
    {
        $data = ['data' => $content];

        parent::__construct($data, $status, $headers);
    }
}
