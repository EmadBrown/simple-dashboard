<?php
/**
 * Created by PhpStorm.
 * User: emadb
 * Date: 20/12/2018
 * Time: 10:14
 */

namespace App\Services;

use App\User;

class SidebarServices
{

    /**
     * @return mixed
     */
    public function numberOfPosts(User $user)
    {
        // Count number of posts for this users
        return $user->Posts()->count();
    }

    /**
     * @return int
     */
    public function numberOfUsers()
    {
        return User::all()->count();
    }
}
