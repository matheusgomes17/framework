<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserDeleted
 *
 */
class UserDeleted extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.deleted_permanently')];
    }
}
