<?php

namespace MVG\Units\Authentication\Http\Controllers;

use Domains\Users\Exceptions\UserException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use MVG\Domains\Users\Models\User;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Authentication\Http\Requests\UserRequest;

/**
 * Class RegisterController
 * @package MVG\Units\Authentication\Http\Controllers
 */
class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \MVG\Domains\Users\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        try {
            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (UserException $e) {
            return response()
                ->json(['error_generating_token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()
            ->json(['token' => $token], Response::HTTP_CREATED);
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
