<?php

namespace MVG\Units\Authentication\Http\Controllers;

use MVG\Domains\Authentication\Models\Role;
use MVG\Domains\Authentication\Services\AbstractService;
use MVG\Domains\Authentication\Services\CreateRoleService;
use MVG\Domains\Authentication\Services\DeleteRoleService;
use MVG\Domains\Authentication\Services\UpdateRoleService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Authentication\Http\Requests\ManageRoleRequest;
use MVG\Units\Authentication\Http\Requests\StoreRoleRequest;
use MVG\Units\Authentication\Http\Requests\UpdateRoleRequest;
use MVG\Units\Authentication\Http\Resources\CreateRole;
use MVG\Units\Authentication\Http\Resources\RoleResource;
use MVG\Units\Authentication\Http\Resources\UpdateRole;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleController
 * @package MVG\Units\Authentication\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * @param ManageRoleRequest $request
     * @param AbstractService $service
     * @return mixed
     */
    public function index(ManageRoleRequest $request, AbstractService $service)
    {
        $roles = $service->paginate();

        return RoleResource::collection($roles);
    }

    /**
     * @param StoreRoleRequest $request
     * @param CreateRoleService $service
     * @return static
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function store(StoreRoleRequest $request, CreateRoleService $service)
    {
        $role = $service->create($request->only('name', 'associated-permissions', 'permissions', 'sort'));

        return CreateRole::make($role);
    }

    /**
     * @param Role $role
     * @param ManageRoleRequest $request
     * @param AbstractService $service
     * @return static
     */
    public function show(Role $role, ManageRoleRequest $request, AbstractService $service)
    {
        $role = $service->findById($role->id);

        return RoleResource::make($role);
    }

    /**
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @param UpdateRoleService $service
     * @return static
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function update(Role $role, UpdateRoleRequest $request, UpdateRoleService $service)
    {
        $role = $service->update($role->id, $request->only('name', 'permissions'));

        return UpdateRole::make($role);
    }

    /**
     * @param Role $role
     * @param ManageRoleRequest $request
     * @param DeleteRoleService $service
     * @return mixed
     */
    public function destroy(Role $role, ManageRoleRequest $request, DeleteRoleService $service)
    {
        $service->delete($role->id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
