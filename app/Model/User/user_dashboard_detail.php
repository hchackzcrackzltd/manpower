<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_dashboard_detail extends Model
{
  use SoftDeletes;
  public $dates=['deleted_at'];
  public function scopeUserown($query)
  {
    return $query->where('user_id',Auth::user()->username);
  }

  public function scopeMyjob($query){
    return $query->where('user_em_id',Auth::user()->username);
  }

  public function scopeNotapp($query){
    return $query->where('user_id','!=',Auth::user()->username);
  }

  public function scopeStatus($query,$data)
  {
    return $query->where('status',$data);
  }

  public function getemp(){
    return $this->hasMany('App\Model\Form\employee_new','id','id');
  }

  public function getnamereq()
  {
    return $this->hasOne('App\Model\Masterdata\employee','id','user_id');
  }

  public function getAgeAttribute($value)
  {
    return str_replace(';', ' - ', $value);
  }
}
