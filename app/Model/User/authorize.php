<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class authorize extends Model
{
    public $timestamps=false;
    protected $fillable=['username','menu','is_admin'];
    public function scopeGetau($value,$data){
      return $value->where(['username'=>auth()->user()->username,'menu'=>$data]);
    }
    public function getRouteKeyName(){
      return 'username';
    }
}
