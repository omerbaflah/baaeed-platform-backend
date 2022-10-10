<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ExceptionResponseHandler
{
    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Throwable $e)
    {
        return match (true)
        {
            $this->isNotFoundHttpException($e) => $this->notFoundHttpEndpoint(),
            $this->isModelNotFoundException($e) => $this->modelNotFound(),
        };
    }

    /**
     * Determines if the given exception is a http route not found.
     *
     * @param Throwable $e
     * @return bool
     */
    protected function isNotFoundHttpException(Throwable $e)
    {
        return $e instanceof NotFoundHttpException;
    }

    /**
     * Returns json response for http route not found exception.
     */
    protected function notFoundHttpEndpoint(int $statusCode = 404)
    {
        return sendErrorResponse(__('exceptions.route_not_found'), null, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Throwable $e
     * @return bool
     */
    protected function isModelNotFoundException(Throwable $e): bool
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param int $statusCode
     */
    protected function modelNotFound(int $statusCode = 404)
    {
        return sendErrorResponse(__('exceptions.record_not_found'), null, $statusCode);
    }
}
