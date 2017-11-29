<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ApiExceptionHandlerTrait
{
    /**
     * Determines if request is an API call.
     * @param Request $request
     * @return bool `true` if the request URI starts with '/api', `false` otherwise
     */
    protected function isApiCall(Request $request)
    {
        return $request->is('api/*');
    }

    /**
     * Creates a new JSON response based on exception type.
     * @param Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $exception)
    {
        switch (true) {
            case $this->isModelNotFoundException($exception):
                return $this->jsonErrorResponse('Record not Found', 404);
            default:
                return $this->jsonErrorResponse('Bad request', 400);
        }
    }

    /**
     * Returns json response.
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonErrorResponse($message, $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     * @param Exception $exception
     * @return bool
     */
    protected function isModelNotFoundException(Exception $exception)
    {
        return $exception instanceof ModelNotFoundException;
    }
}
