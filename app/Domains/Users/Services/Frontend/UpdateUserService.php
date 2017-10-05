<?php

namespace MVG\Domains\Users\Services\Frontend;

use Illuminate\Support\Facades\Hash;
use MVG\Domains\Authentication\Notifications\UserNeedsConfirmation;
use MVG\Domains\Users\Exceptions\UserException;

/**
 * Class UpdateUserService
 * @package MVG\Domains\Users\Services\Frontend
 */
class UpdateUserService extends AbstractService
{
    /**
     * @param mixed $id
     * @param array $input
     *
     * @return array|bool
     * @throws UserException
     */
    public function update($id, array $input)
    {
        $user = $this->userRepository->getById($id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];

        if ($user->canChangeEmail()) {

            //Address is not current address so they need to reconfirm
            if ($user->email != $input['email']) {

                //Emails have to be unique
                if ($this->userRepository->getItemByColumn($input['email'], 'email')) {
                    throw new UserException(__('user::exceptions.email_taken'));
                }

                // Force the user to re-verify his email address
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->confirmed = 0;
                $user->email = $input['email'];
                $updated = $user->save();

                // Send the new confirmation e-mail
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));

                return [
                    'success' => $updated,
                    'email_changed' => true,
                ];
            }
        }

        return $user->save();
    }

    /**
     * @param $input
     *
     * @return bool
     * @throws UserException
     */
    public function updatePassword($input)
    {
        $user = $this->userRepository->getById(auth()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);

            return $user->save();
        }

        throw new UserException(__('user::exceptions.password.change_mismatch'));
    }

}