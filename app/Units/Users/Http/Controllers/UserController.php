<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Services\AbstractService;
use MVG\Domains\Users\Services\CreateUserService;
use MVG\Domains\Users\Services\UpdateUserService;
use MVG\Domains\Users\Services\DeleteUserService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\ManageUserRequest;
use MVG\Units\Users\Http\Requests\StoreUserRequest;
use MVG\Units\Users\Http\Requests\UpdateUserRequest;
use MVG\Units\Users\Http\Resources\UserResource;
use MVG\Units\Users\Http\Resources\UserStore;
use MVG\Units\Users\Http\Resources\UserUpdate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package MVG\Units\Users\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param ManageUserRequest $request
     * @param AbstractService $service
     * @return UserResource
     */
    public function index(ManageUserRequest $request, AbstractService $service)
    {
        $users = $service->paginate();

        return UserResource::collection($users);
    }

    /**
     * @param StoreUserRequest $request
     * @param CreateUserService $service
     * @return UserResource
     */
    public function store(StoreUserRequest $request, CreateUserService $service)
    {
        $user = $service->create($request->only(
            'first_name',
            'last_name',
            'email',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));

        return UserStore::make($user);
    }

    /**
     * @param User $user
     * @param ManageUserRequest $request
     * @param AbstractService $service
     * @return UserResource
     */
    public function show(User $user, ManageUserRequest $request, AbstractService $service)
    {
        $user = $service->findById($user->id);

        return UserResource::make($user);
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @param UpdateUserService $service
     * @return UserResource
     */
    public function update(User $user, UpdateUserRequest $request, UpdateUserService $service)
    {
        $user = $service->update($user->id, $request->only(
            'first_name',
            'last_name',
            'email',
            'roles',
            'permissions'
        ));

        return UserUpdate::make($user);
    }

    /**
     * @param User $user
     * @param DeleteUserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function destroy(User $user, DeleteUserService $service)
    {
        $service->delete($user->id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
