<?php

namespace MVG\Domains\Users\Services\Frontend;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Authentication\Notifications\UserNeedsConfirmation;
use MVG\Domains\Users\Events\UserCreated;
use MVG\Domains\Users\Events\UserProviderRegistered;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\SocialAccount;
use MVG\Domains\Users\Models\User;

/**
 * Class RegisterSocialUserService
 *
 */
class RegisterSocialUserService extends AbstractService
{
    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function createSocialUserStub($data = [])
    {
        $user = [
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data,
            'active'            => 1,
            'confirmed'         => 1,
            'password'          => null,
        ];

        return $user;
    }

    /**
     * @param $data
     * @param $provider
     *
     * @return mixed
     * @throws UserException
     */
    public function findOrCreateProvider($data, $provider)
    {
        // User email may not provided.
        $user_email = $data->email ?: "{$data->id}@{$provider}.com";

        // Check to see if there is a user with this email first.
        $user = $this->userRepository->getItemByColumn($user_email, 'email');

        /*
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (! $user) {

            // Registration is not enabled
            if (! config('user.registration')) {
                throw new UserException(__('exceptions.registration_disabled'));
            }

            // Get users first name and last name from their full name
            $nameParts = $this->getNameParts($data->getName());
            $user = $this->userRepository->create($this->createSocialUserStub($nameParts));

            event(new UserProviderRegistered($user));
        }

        // See if the user has logged in with this social account before
        if (! $user->hasProvider($provider)) {
            // Gather the provider data for saving and associate it with the user
            $user->providers()->save(new SocialAccount([
                'provider' => $provider,
                'provider_id' => $data->id,
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]));
        } else {
            // Update the users information, token and avatar can be updated.
            $user->providers()->update([
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]);
        }

        // Return the user object
        return $user;
    }

    /**
     * @param $fullName
     *
     * @return array
     */
    protected function getNameParts($fullName)
    {
        $parts = array_values(array_filter(explode(' ', $fullName)));
        $size = count($parts);
        $result = [];

        if (empty($parts)) {
            $result['first_name'] = null;
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size == 1) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        }

        return $result;
    }
}