<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Model\Masterdata\approve as apdb;

class approve
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function myapp(User $user,apdb $data)
     {
       return $data->user_id==$user->username&&$data->status==1;
     }

     public function showapp(User $user,apdb $data)
     {
       return $data->user_id==$user->username;
     }
}
