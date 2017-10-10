<?php

namespace MVG\Domains\Users\Models\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\HasMany;
use MVG\Domains\Users\Models\SocialAccount;

/**
 * Trait UserRelationship
 *
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers() : HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}