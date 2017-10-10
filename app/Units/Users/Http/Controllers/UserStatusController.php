<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Services\UserStatusService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\ManageUserRequest;
use MVG\Units\Users\Http\Resources\RestoreUser;
use MVG\Units\Users\Http\Resources\UserMark;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserStatusController
 *
 */
class UserStatusController extends Controller
{
    /**
     * @var UserStatusService
     */
    protected $statusService;

    /**
     * @param UserStatusService $statusService
     */
    public function __construct(UserStatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
//    public function getDeactivated(ManageUserRequest $request)
//    {
//        $user = '';
//        return view('backend.auth.user.deactivated')
//            ->withUsers($this->userRepository->getInactivePaginated(25, 'id', 'asc'));
//    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
//    public function getDeleted(ManageUserRequest $request)
//    {
//        return view('backend.auth.user.deleted')
//            ->withUsers($this->userRepository->getDeletedPaginated(25, 'id', 'asc'));
//    }

    /**
     * @param $tenant
     * @param User $user
     * @param $status
     * @param ManageUserRequest $request
     * @return static
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function mark($tenant, User $user, $status, ManageUserRequest $request)
    {
        $user = $this->statusService->mark($user, $status);

        return UserMark::make($user);
    }

    /**
     * @param $tenant
     * @param User $deletedUser
     * @param ManageUserRequest $request
     * @return mixed
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function delete($tenant, User $deletedUser, ManageUserRequest $request)
    {
        $this->statusService->forceDelete($deletedUser);

        return response()->json(['message' => __('user::alerts.deleted_permanently')], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param $tenant
     * @param User $deletedUser
     * @param ManageUserRequest $request
     * @return static
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function restore($tenant, User $deletedUser, ManageUserRequest $request)
    {
        $user = $this->statusService->restore($deletedUser);

        return RestoreUser::make($user);
    }
}
