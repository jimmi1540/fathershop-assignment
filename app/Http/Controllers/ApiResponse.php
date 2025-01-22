<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class ApiResponse
{

    public function successResponse($message, $data, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function validationErrorResponse(ValidationException $e)
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
    }
    public function errorResponse($message, Exception $e)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $e->getMessage(),
        ], 500);
    }
}

