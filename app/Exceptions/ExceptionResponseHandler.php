<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
            $this->isValidationException($e) => $this->failedValidation($e),
            $this->isAuthorizationException($e) => $this->forbidden(),
            $this->isUnauthorizedException($e) => $this->unauthorized(),
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

    /**
     * Determines if the given exception is an authorization or unauthorized exception.
     *
     * @param Throwable $e
     */
    protected function isAuthorizationException(Throwable $e): bool
    {
        return $e instanceof AuthorizationException;
    }

    /**
     * Returns json response for forbidden exception.
     *
     * @param int $statusCode
     */
    protected function forbidden(int $statusCode = 403)
    {
        return sendErrorResponse(__('exceptions.forbidden'), null, $statusCode);
    }

    /**
     * Determines if the given exception is an unauthorized http or authentication exception.
     *
     * @param Throwable $e
     */
    protected function isUnauthorizedException(Throwable $e): bool
    {
        return $e instanceof UnauthorizedHttpException || $e instanceof AuthenticationException;
    }

    /**
     * Determines if the given exception is an unauthorized http or authentication exception.
     *
     * @param int $statusCode
     */
    protected function unauthorized(int $statusCode = 401)
    {
        return sendErrorResponse(__('exceptions.login_required'), null, $statusCode);
    }

    /**
     * Determines if the given exception is a validation exception.
     *
     * @param Throwable $e
     */
    protected function isValidationException(Throwable $e): bool
    {
        return $e instanceof ValidationException;
    }

    /**
     * Returns json response for validation errors exception.
     *
     * @param $e
     * @param int $statusCode
     */
    protected function failedValidation($e, int $statusCode = 422)
    {
        return sendErrorResponse(__('messages.validation_error'), null, $statusCode, $e->errors());
    }
}
