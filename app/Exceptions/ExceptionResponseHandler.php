<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
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
        //
    }
}
