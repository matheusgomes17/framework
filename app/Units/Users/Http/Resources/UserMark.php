<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserMark
 * @package MVG\Units\Users\Http\Resources
 */
class UserMark extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.updated')];
    }
}
