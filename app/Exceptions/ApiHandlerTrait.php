<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ApiHandlerTrait
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
     * Force JSON rendering on all API calls
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function prepareResponse($request, Exception $e)
    {
        if ($this->isApiCall($request)) {
            return $this->prepareJsonResponse($request, $e);
        }

        return parent::prepareResponse($request, $e);
    }

    /**
     * Prepare exception for rendering.
     *
     * @param  \Exception  $e
     * @return \Exception
     */
    protected function prepareException(Exception $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return new NotFoundHttpException('Resource not found', $e);
        } elseif ($e instanceof AuthorizationException) {
            return new AccessDeniedHttpException('Access denied', $e);
        } elseif ($e instanceof TokenMismatchException) {
            return new HttpException(419, 'Authentication timed out', $e);
        } else {
            return $e;
        }
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($this->isApiCall($request)) {
            return parent::prepareJsonResponse($request, new HttpException(401, 'Unauthenticated', $exception));
        }

        return parent::unauthenticated($request, $exception);
    }
}
