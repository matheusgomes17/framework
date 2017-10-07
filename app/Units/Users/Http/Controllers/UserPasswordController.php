<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Services\UserPasswordService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\UpdateUserPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserPasswordController
 * @package MVG\Units\Users\Http\Controllers
 */
class UserPasswordController extends Controller
{
    /**
     * @var UserPasswordService
     */
    protected $userPasswordService;

    public function __construct(UserPasswordService $userPasswordService)
    {
        $this->userPasswordService = $userPasswordService;
    }

    /**
     * @param $tenant
     * @param User $user
     * @param UpdateUserPasswordRequest $request
     * @return mixed
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function update($tenant, User $user, UpdateUserPasswordRequest $request)
    {
        $this->userPasswordService->updatePassword($user, $request->only('password'));

        return response()->json(['message' => __('user::alerts.updated_password')], Response::HTTP_OK);
    }
}
