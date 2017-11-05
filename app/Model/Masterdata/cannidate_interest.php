<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;

class cannidate_interest extends Model
{
    protected $fillable=['cannidate_id','user_id','manpower_id'];

    public function scopeMycan($query,$data)
    {
      return $query->where(['user_id'=>auth()->user()->username,'manpower_id'=>$data->id]);
    }

    public function scopeAllcan($query,$data)
    {
      return $query->where(['manpower_id'=>$data->id]);
    }

    public function getcandidate()
    {
      return $this->hasOne('App\Model\Eform\eform_form','id','cannidate_id');
    }

    public function getmanpower()
    {
      return $this->hasOne('App\Model\User\user_dashboard_detail','id','manpower_id');
    }
}
