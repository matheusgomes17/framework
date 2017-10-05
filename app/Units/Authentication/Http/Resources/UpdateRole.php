<?php

namespace MVG\Units\Authentication\Http\Resources;

/**
 * Class UpdateRole
 * @package MVG\Units\Authentication\Http\Resources
 */
class UpdateRole extends RoleResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return ['message' => __('auth::alerts.roles.updated')];
    }
}
