<?php

namespace MVG\Domains\Users\Models\Traits\Relationship;

use MVG\Domains\Users\Models\SocialAccount;

/**
 * Trait UserRelationship
 * @package MVG\Domains\Users\Models\Traits\Relationship
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        //return $this->hasMany(Session::class);
    }
}