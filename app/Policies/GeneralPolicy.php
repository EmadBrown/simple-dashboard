<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function onlyAdmin(User $user)
    {
        return $user->type == 'admin';
    }


    /**
     * @param User $user
     * @return bool
     */
    public function onlyOwner(User $user)
    {
        return auth()->user()->id == $user->id;
    }
}
