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
 * return error response.
 *
 * @param mixed $message
 * @param null|mixed $data
 * @param mixed $status_code
 *
 * @return \Illuminate\Http\JsonResponse
 */
function sendErrorResponse($message = 'Error', $data = null, $status_code = 404)
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

