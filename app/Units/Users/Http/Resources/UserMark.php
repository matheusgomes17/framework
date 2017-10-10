<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserMark
 *
 */
class UserMark extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.updated')];
    }
}
