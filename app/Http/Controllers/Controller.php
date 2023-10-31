<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // response
    public function response(array|object $data)
    {
        return response()->json([
            'data' => $data,
        ]);
    }

    // success
    public function success(string $message = null, array|object $data = null)
    {
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => $message ?? 'Success',
            'data' => $data
        ]);
    }

    // error
    public function error(string $message = null, array|object $data = null)
    {
        return response()->json([
            'success' => false,
            'status' => 'error',
            'message' => $message ?? 'Something went wrong',
            'data' => $data
        ]);
    }
}
