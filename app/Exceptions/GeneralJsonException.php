<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GeneralJsonException extends Exception
{
    protected $code = 422;

    public function render($request)
    {
        // Log an alert message
        Log::alert('An alert message goes here: ' . $this->getMessage());

        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
    }
}
