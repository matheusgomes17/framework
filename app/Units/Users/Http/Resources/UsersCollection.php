<?php

namespace MVG\Units\Users\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class UsersCollection
 * @package MVG\Units\Users\Http\Resources
 */
class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
