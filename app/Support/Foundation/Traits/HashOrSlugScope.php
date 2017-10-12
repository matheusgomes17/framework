<?php

namespace MVG\Support\Foundation\Traits;

use Hashids;

/**
 * Class HashOrSlugScope
 *
 */
trait HashOrSlugScope
{
    public function scopeWhereHashOrSlug($query, $value)
    {
        //check for hashid (decode method returns empty array when hash is invalid)
        if (count(Hashids::decode($value)) > 0) {
            $id = Hashids::decode($value)[0];

            return $query->whereId($id);
        } //find by slug if hashid is invalid
        else {
            return $query->whereSlug($value);
        }
    }
}