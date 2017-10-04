<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Services\UserService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\ManageUserRequest;
use MVG\Units\Users\Http\Requests\StoreUserRequest;
use MVG\Units\Users\Http\Requests\UpdateUserRequest;
use MVG\Units\Users\Http\Resources\UserResource;

/**
 * Class UserController
 * @package MVG\Units\Users\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param ManageUserRequest $request
     * @return UserResource
     */
    public function index(ManageUserRequest $request)
    {
        $users = $this->userService->paginate();

        return UserResource::collection($users);
    }

    /**
     * @param StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->create($request->toArray());
        $users = $this->userService->paginate();

        return UserResource::collection($users);
    }

    /**
     * @param $id
     * @param ManageUserRequest $request
     * @return UserResource
     */
    public function show($id, ManageUserRequest $request)
    {
        $user = $this->userService->findById($id);

        return UserResource::make($user);

    }


    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userService->update($id, $request->all());

        return UserResource::collection($user);
    }


    public function destroy($id)
    {
        $this->userService->delete($id);

        return response()->json();
    }
}
