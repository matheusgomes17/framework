<?php

namespace MVG\Domains\Users\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 * @package MVG\Domains\Users\Models
 */
class SocialAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_accounts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider', 'provider_id', 'token', 'avatar'];
}