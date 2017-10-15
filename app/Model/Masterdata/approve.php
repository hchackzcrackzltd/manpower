<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class approve extends Model
{
    use SoftDeletes;
    protected $fillable=['request_id','type','user_id','level','status','reason'];
    protected $dates=['deleted_at'];

    public function scopeGetmyapp($value,array $id){
      return $value->where('user_id',auth()->user()->username)
      ->whereIn('status',$id[1])->whereIn('type',$id[0]);
    }

    public function getmyreq(){
      return $this->hasOne('App\Model\User\user_dashboard_detail', 'id', 'request_id');
    }

    public function getmyrsg(){
      return $this->hasOne('App\Model\User\user_resign_detail', 'id', 'request_id');
    }

    public function getemployee(){
      return $this->hasOne('App\Model\Masterdata\employee','id','user_id');
    }

    public function scopeListapp($value,array $data)
    {
      return $value->where([
        'request_id'=>$data[0]
      ])->whereIn('type',$data[1])->orderBy('level','asc');
    }

    public function scopeMyapp($value,array $data)
    {
      return $value->where([
        'request_id'=>$data[0],
        'type'=>$data[1],
        'user_id'=>auth()->user()->username]);
    }

    public function getRouteKeyName(){
      return 'request_id';
    }
}
