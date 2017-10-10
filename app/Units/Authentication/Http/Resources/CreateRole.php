<?php

namespace MVG\Units\Authentication\Http\Resources;

/**
 * Class CreateRole
 *
 */
class CreateRole extends RoleResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return ['message' => __('auth::alerts.roles.created')];
    }
}
