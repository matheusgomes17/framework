<?php

namespace MVG\Units;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as LaravelExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class ExceptionHandler
 * @package MVG\Units
 */
class ExceptionHandler extends LaravelExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(\Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Exception $exception)
    {
        if ($request->expectsJson()) {
            return $this->handleExceptionJsonResponse($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle the JSON response for all the exceptions.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function handleExceptionJsonResponse($request, \Exception $e)
    {
        // If it's an authentication exception then return a JSON response with status code of 401
        if ($e instanceof UnauthorizedHttpException) {
            return $this->handleUnauthorizedHttpException($e);
        }

        // If it's a validation exception then return a JSON response with status code of 422
        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        // When middlweare auth:api is used
        // If it's an authentication exception then return a JSON response with status code of 401
        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }

        return $this->makeResponseError($e);
    }

    /**
     * Handle the JSON response for the UnauthorizedHttpException.
     *
     * @param UnauthorizedHttpException $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleUnauthorizedHttpException(UnauthorizedHttpException $e)
    {
        if ($this->tokenIsExpired($e)) {

            return $this->makeResponseError($e, 'token_expired');
        }

        return $this->makeResponseError($e);
    }

    /**
     * Create and return the error response.
     *
     * @param \Exception $e
     * @param string $reason
     * @return \Illuminate\Http\JsonResponse
     */
    protected function makeResponseError(\Exception $e, $reason = null)
    {
        $code = 500;

        $body = [
            'messages' => [$e->getMessage()],
        ];

        // Attribute to complement the error and highlight a specific situation for the client.
        $body['reason'] = $reason ? $reason : null;

        // If it's a HttpException then use the appropriate HTTP status code instead of 500
        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
        }

        // If the debugging is on then include the exception trace in the body of the response
        if (config('app.debug')) {
            $body['trace'] = $e->getTrace();
        }

        return response()->json($body, $code);
    }

    /**
     * Checks if there was an error related to jwt token.
     *
     * @param array $headers
     * @return bool
     * @internal param array $header
     */
    private function hasHeaderWithChallengeJwt(array $headers)
    {
        return isset($headers['WWW-Authenticate']) && $headers['WWW-Authenticate'] == 'jwt-auth';
    }

    private function tokenIsExpired(UnauthorizedHttpException $e)
    {
        $headers = $e->getHeaders();
        $message = $e->getMessage();
        return (bool)$this->hasHeaderWithChallengeJwt($headers) && $this->hasExpiredTokenMessage($message);
    }

    /**
     * Checks for expired token message.
     *
     * @param string $message
     * @return bool
     */
    private function hasExpiredTokenMessage($message)
    {
        return false === !strpos($message, 'expired');
    }
}
