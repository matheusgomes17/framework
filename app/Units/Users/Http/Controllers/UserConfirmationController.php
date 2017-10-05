<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Services\UserConfirmationService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\ManageUserRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserConfirmationController
 * @package MVG\Units\Users\Http\Controllers
 */
class UserConfirmationController extends Controller
{
    /**
     * @var UserConfirmationService
     */
    protected $confirmationService;

    public function __construct(UserConfirmationService $confirmationService)
    {
        $this->confirmationService = $confirmationService;
    }

    /**
     * @param User $user
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function sendConfirmationEmail(User $user, ManageUserRequest $request)
    {
        $this->confirmationService->sendConfirmationEmail($user);

        return response()->json(['message' => __('user::alerts.confirmation_email')], Response::HTTP_OK);
    }

    /**
     * @param User $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function confirm(User $user, ManageUserRequest $request)
    {
        $this->confirmationService->confirm($user);

        return response()->json(['message' => __('user::alerts.confirmed')], Response::HTTP_OK);
    }

    /**
     * @param User $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function unconfirm(User $user, ManageUserRequest $request)
    {
        $this->confirmationService->unconfirm($user);

        return response()->json(['message' => __('user::alerts.unconfirmed')], Response::HTTP_OK);
    }
}