<?php

namespace MVG\Units\Authentication\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class RoleResource
 * @package MVG\Units\Authentication\Http\Resources
 */
class RoleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ];
    }
}
