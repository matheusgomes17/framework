<?php

namespace MVG\Domains\Users\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Tymon\JWTAuth\Contracts\JWTSubject;
use MVG\Domains\Users\Models\Traits\SendUserPasswordReset;
use MVG\Domains\Users\Models\Traits\Attribute\UserAttribute;
use MVG\Domains\Users\Models\Traits\Relationship\UserRelationship;
use MVG\Domains\Users\Models\Traits\Scope\UserScope;

/**
 * Class User
 *
 */
class User extends Authenticatable implements JWTSubject
{
    use HasRoles,
        LogsActivity,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        UserRelationship,
        UserScope;

    protected $guard_name = 'api_tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'active', 'confirmation_code', 'confirmed'
    ];

    /**
     * The columns that are available to be logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'first_name', 'last_name', 'email', 'active', 'confirmed'
    ];

    /**
     * Whether or not to only log the columns that changed.
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Can change this to just 'users' if you don't want to be able to differentiate between the types of history.
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getLogNameToUse(string $eventName = ''): string
    {
        return $this->getTable().'_'.$eventName;
    }

    /**
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.first_name :causer.last_name has {$eventName} :subject.first_name :subject.last_name";
    }
}
