<?php

namespace MVG\Units\Authentication\Http\Controllers;

use Illuminate\Http\Request;
use MVG\Support\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class ResetPasswordController
 * @package MVG\Units\Authentication\Http\Controllers
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials =  $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        return array_merge($credentials, [
            'password_confirmation' => $credentials['password'],
        ]);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse($response)
    {
        $token = null;

        try {
            $user = $this->guard()->user();

            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (\Exception $e) {
            throw new \Exception();
        }

        return response()->json([
            'status' => trans($response),
            'token' => $token,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['error' => trans($response)], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
