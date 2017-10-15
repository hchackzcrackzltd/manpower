<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Model\User\authorize as audb;

class authorize
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function acman(User $us,audb $data)
     {
       return $us->is_admin==0&&$data->menu==1;
     }
     public function acrgn(User $us,audb $data)
     {
       return $us->is_admin==0&&$data->menu==2;
     }
     public function acapp(User $us,audb $data)
     {
       return $us->is_admin==0&&$data->menu==3;
     }
}
