<?php

namespace MVG\Units\Authentication\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use MVG\Support\Foundation\Auth\TenantManager;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Lang;
use MVG\Support\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class LoginController
 *
 */
class LoginController extends Controller
{
    use ThrottlesLogins;

    /**
     * Issue a JWT token when valid login credentials are presented.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // grab credentials from request
        $credentials = $this->credentials($request);

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = app('tymon.jwt.auth')->attempt($credentials)) {
                // Increments login attempts
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => 'invalid_credentials'], HttpResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // Increments login attempts
            $this->incrementLoginAttempts($request);

            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
        $tenantManager = app(TenantManager::class);

        if($tenantManager->getTenant() && !$tenantManager->isSubdomainExcept()){
            $data['tenant_id'] = $tenantManager->getTenant()->id;
        }

        return $data;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json(['message' => $message], HttpResponse::HTTP_TOO_MANY_REQUESTS);
    }
}
