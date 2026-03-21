<?php

namespace App\Exceptions;

public function render($request, Throwable $exception)
{
    if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
        return response()->json([
            'success' => false,
            'message' => 'Resource not found',
        ], 404);
    }

    if ($exception instanceof \Illuminate\Validation\ValidationException) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors'  => $exception->errors(),
        ], 422);
    }

    return response()->json([
        'success' => false,
        'message' => 'Server error',
        'error'   => $exception->getMessage(), // hide in production
    ], 500);
}
