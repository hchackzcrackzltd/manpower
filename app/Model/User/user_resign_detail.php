<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_resign_detail extends Model
{
  use SoftDeletes;
  public $dates=['deleted_at'];
  public function scopeUserown($query)
  {
    return $query->where('user_id',auth()->user()->username);
  }
  public function scopeMyjob($query){
    return $query->where('user_em_id',auth()->user()->username);
  }
  public function scopeNotapp($query){
    return $query->where('user_id','!=',auth()->user()->username);
  }
  public function getnamereq()
  {
    return $this->hasOne('App\Model\Masterdata\employee','id','user_id');
  }
  public function getnameemprsg()
  {
    return $this->hasOne('App\Model\Masterdata\employee','id','code');
  }
}
