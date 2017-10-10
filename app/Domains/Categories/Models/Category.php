<?php

namespace MVG\Domains\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use MVG\Domains\Authentication\Models\Traits\Scope\TenantModels;
use MVG\Domains\Categories\Models\Traits\Attribute\CategoryAttribute;
use MVG\Domains\Categories\Models\Traits\Relationship\CategoryRelationship;
use MVG\Domains\Categories\Models\Traits\Scope\CategoryScope;

/**
 * Class Category
 *
 */
class Category extends Model
{
    use CategoryAttribute,
        CategoryRelationship,
        CategoryScope,
        TenantModels;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

}