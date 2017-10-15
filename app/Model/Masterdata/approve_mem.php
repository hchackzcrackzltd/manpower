<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class approve_mem extends Model
{
  use SoftDeletes;
    protected $fillable=['approve_func_id','employee_id','level'];
    protected $dates=['deleted_at'];

    public function getuser()
    {
    	return $this->hasOne('App\Model\Masterdata\employee','id','employee_id');
    }

    public function scopeNotapp($value,$id){
      return $value->where([['employee_id','!=', auth()->user()->username],
    ['level','>',$id]]);
    }

    public function scopeGetlv($value){
      return $value->where([['employee_id','=', auth()->user()->username]]);
    }
}
