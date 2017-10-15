<?php

namespace App\Policies;

use App\User;
use App\Model\User\user_resign_detail as usd;
use Illuminate\Auth\Access\HandlesAuthorization;

class user_resign_detail
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the userResignDetail.
     *
     * @param  \App\User  $user
     * @param  \App\Model\User\user_resign_detail  $userResignDetail
     * @return mixed
     */
    public function view(User $user, usd $userResignDetail)
    {
      return $user->username===$userResignDetail->user_id;
    }

    /**
     * Determine whether the user can create userResignDetails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the userResignDetail.
     *
     * @param  \App\User  $user
     * @param  \App\Model\User\user_resign_detail  $userResignDetail
     * @return mixed
     */
    public function update(User $user, usd $userResignDetail)
    {
        //
    }

    /**
     * Determine whether the user can delete the userResignDetail.
     *
     * @param  \App\User  $user
     * @param  \App\Model\User\user_resign_detail  $userResignDetail
     * @return mixed
     */
    public function delete(User $user, usd $userResignDetail)
    {
        //
    }
}
