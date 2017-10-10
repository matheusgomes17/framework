<?php

namespace MVG\Domains\Users\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use MVG\Domains\Users\Contracts\Repositories\UserRepositoryContract;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Support\Domain\Database\Repository\Traits\CacheResults;
use MVG\Domains\Users\Models\User;

/**
 * Class UserRepository
 *
 */
class UserRepository extends BaseEloquentRepository implements UserRepositoryContract
{
    use CacheResults;

    /**
     * @var array
     */
    protected $relationships = ['activity'];

    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return mixed
     */
    public function getUnconfirmedCount() : int
    {
        return $this->model
            ->where('confirmed', 0)
            ->count();
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    /**
     * @param User $user
     * @param      $status
     *
     * @return User
     * @throws GeneralException
     */
    public function mark(User $user, $status) : User
    {
        if (auth()->id() == $user->id && $status == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
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
        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }
    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function forceDelete(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }
        return DB::transaction(function () use ($user) {
            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));
                return $user;
            }
            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }
        if ($user->restore()) {
            event(new UserRestored($user));
            return $user;
        }
        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }
}