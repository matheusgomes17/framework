<?php

namespace MVG\Units\Authentication\Http\Controllers;

use MVG\Domains\Users\Services\Frontend\RegisterUserService;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Authentication\Http\Requests\CreateUserRequest;

/**
 * Class RegisterController
 *
 */
class RegisterController extends Controller
{
    /**
     * @var RegisterUserService
     */
    protected $registerService;

    public function __construct(RegisterUserService $registerService)
    {
        $this->middleware('guest');
        $this->registerService = $registerService;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  CreateUserRequest  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(CreateUserRequest $request)
    {
        $user = $this->registerService->create($request->toArray());
        $this->guard()->login($user);

        try {
            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (\Exception $e) {
            return response()->json(['error_generating_token'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['token' => $token], HttpResponse::HTTP_CREATED);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
