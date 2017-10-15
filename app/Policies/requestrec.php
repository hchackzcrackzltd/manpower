<?php

namespace App\Policies;

use App\User;
use App\Model\Form\request;
use Illuminate\Auth\Access\HandlesAuthorization;

class requestrec
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function view(User $user, request $request)
    {
        return $user->username==$request->user_id&&$request->status=='CN';
    }

    /**
     * Determine whether the user can update the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function update(User $user, request $request)
    {
        return $user->username==$request->user_id&&$request->status=='NP';
    }

    public function edit(User $user, request $request)
    {
        return $user->username==$request->user_id&&$request->status=='NP';
    }

    public function updatesave(User $user, request $request){
      return $user->username==$request->user_id&&$request->status=='NP';
    }

    /**
     * Determine whether the user can delete the request.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Form\request  $request
     * @return mixed
     */
    public function delete(User $user, request $request)
    {
      $status=collect(['NP']);
        return $user->username==$request->user_id && $status->search($request->status)>-1;
    }

    public function cancelman(User $user, request $request){
      return $user->username==$request->user_em_id && $request->status=='AJ';
    }

    public function updateeva(User $user, request $request){
      return $user->username==$request->user_id && $request->status=='JC';
    }

    public function updateassign(User $user, request $request){
      return $user->getrole()->where('menu',1)->first()!==null;
    }

    public function showmyjob(User $user, request $request)
    {
      return $user->username==$request->user_em_id && $request->status=='AJ'&& $user->getrole()->where('menu',2)->first()!==null;
    }

    public function updatemyjob(User $user, request $request)
    {
      return $user->username==$request->user_em_id && $request->status=='AJ' && $user->getrole()->where('menu',2)->first()!==null;
    }
}
