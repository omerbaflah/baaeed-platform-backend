<?php

/**
 * Returns a success HTTP JSON response.
 *
 * @param string $message
 * @param array|null $data
 * @param int $status_code
 *
 * @return JsonResponse
 */
function sendSuccessResponse(string $message = 'OK', array|null $data = null, int $status_code = 200): JsonResponse
{
    $response = [
        'success' => true,
        'message' => $message,
        'data' => $data,
        'status_code' => $status_code,
    ];

    return response()->json(
        $response,
        $status_code
    );
}

/**
 * Returns a failed HTTP JSON response.
 *
 * @param string $message
 * @param array|null $data
 * @param int $status_code
 *
 * @return JsonResponse
 */
function sendFailedResponse(string $message = 'Error', array|null $data = null, int $status_code = 404): JsonResponse
{
    $response = [
        'success' => false,
        'message' => $message,
        'data' => $data,
        'status_code' => $status_code
    ];

    return response()->json(
        $response,
        $status_code
    );
}

