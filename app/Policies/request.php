<?php

namespace App\Policies;

use App\User;
use App\Model\User\user_dashboard_detail as reqdb;
use Illuminate\Auth\Access\HandlesAuthorization;

class request
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function view(User $user,reqdb $request){
      return $user->username==$request->user_id;
    }

    public function show(User $user,reqdb $request){
      return $user->username==$request->user_id&&$request->status=='JC';
    }

    /**
     * Determine whether the user can create requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(reqdb $user)
    {
        //
    }

    /**
     * Determine whether the user can update the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function update(User $user, reqdb $request)
    {
      
    }

    /**
     * Determine whether the user can delete the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function delete(User $user, reqdb $request)
    {
        //
    }
}
