<?php

namespace MVG\Domains\Users\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Events\UserDeactivated;
use MVG\Domains\Users\Events\UserPermanentlyDeleted;
use MVG\Domains\Users\Events\UserReactivated;
use MVG\Domains\Users\Events\UserRestored;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;

/**
 * Class UserStatusService
 * @package MVG\Domains\Users\Services
 */
class UserStatusService extends AbstractService
{
    /**
     * @param User $user
     * @param      $status
     *
     * @return User
     * @throws UserException
     */
    public function mark(User $user, $status) : User
    {
        if (auth()->id() == $user->id && $status == 0) {
            throw new UserException(__('user::exceptions.cant_deactivate_self'));
        }

        $user->active = $status;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
                break;
            case 1:
                event(new UserReactivated($user));
                break;
        }

        if ($user->save()) {

            return $user;
        }

        throw new UserException(__('user::exceptions.mark_error'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws UserException
     */
    public function forceDelete(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new UserException(__('user::exceptions.delete_first'));
        }

        return DB::transaction(function () use ($user) {

            if ($user->forceDelete()) {

                event(new UserPermanentlyDeleted($user));

                return $user;
            }

            throw new UserException(__('user::exceptions.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws UserException
     */
    public function restore(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new UserException(__('user::exceptions.cant_restore'));
        }

        if ($user->restore()) {

            event(new UserRestored($user));

            return $user;
        }

        throw new UserException(__('user::exceptions.restore_error'));
    }
}