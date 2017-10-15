<?php

namespace App\Policies;

use App\User;
use App\Model\Form\resign as rsg;
use Illuminate\Auth\Access\HandlesAuthorization;

class resign
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the resign.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\resign  $resign
     * @return mixed
     */
    public function edit(User $user, rsg $resign){
        return $user->username===$resign->user_id && $resign->status==='NP';
    }

    /**
     * Determine whether the user can create resigns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the resign.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\resign  $resign
     * @return mixed
     */
    public function update(User $user, rsg $resign)
    {
        //
    }

    /**
     * Determine whether the user can delete the resign.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\resign  $resign
     * @return mixed
     */
    public function delete(User $user, rsg $resign)
    {
        return $user->username===$resign->user_id && collect(['NP'])->search($resign->status)>-1;
    }

    public function showcn(User $user, rsg $resign){
      return $user->username===$resign->user_id && $resign->status==='CN';
    }

    public function updatersg(User $user, rsg $resign){
      return $user->username===$resign->user_id && $resign->status==='JC';
    }

    public function showrsg(User $user, rsg $resign)
    {
      return $user->username===$resign->user_id && $resign->status==='JC';
    }

    public function showrsgadmin(User $user, rsg $resign)
    {
      return $user->username===$resign->user_em_id && $resign->status==='AJ';
    }

    public function cancelrsg(User $user, rsg $resign)
    {
      return $user->username===$resign->user_em_id && $resign->status==='AJ';
    }
}
