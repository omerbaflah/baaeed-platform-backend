<?php

/**
 * success response method.
 *
 * @param mixed $message
 * @param null|mixed $data
 * @param mixed $status_code
 *
 * @return \Illuminate\Http\JsonResponse
 */
function sendSuccessResponse($message = 'OK', $data = null, $status_code = 200)
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
 * @param null|mixed $errors
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

