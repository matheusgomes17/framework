<?php

namespace MVG\Units\Users\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use MVG\Units\Authentication\Http\Resources\RoleResource;

/**
 * Class UserResource
 * @package MVG\Units\Users\Http\Resources
 */
class UserResource extends Resource
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
            'email' => $this->email,
            'roles' => RoleResource::collection($this->roles),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
