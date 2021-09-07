<?php

namespace App\Http\Services;

class GenerateResponseService
{
    public function execute(string $message, int $statusCode, Array $body, Array $errors = [])
    {
        return response()->json(
            [
                "message" => $message,
                "body" => $body,
                "errors" => $errors
            ],
            $statusCode
        );
    }
}
