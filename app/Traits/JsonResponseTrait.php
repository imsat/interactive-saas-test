<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    /**
     * Return json response.
     *
     * @param $success
     * @param $message
     * @param $data
     * @param $code
     * @param $errors
     * @return JsonResponse
     */
    public function apiResponse($success = true, $message = null, $data = null, $code = 200, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'code' => $code,
            'errors' => $errors,
        ], $code);
    }
}
