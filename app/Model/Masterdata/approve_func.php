<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class approve_func extends Model
{
  use SoftDeletes;
    protected $fillable=['function_id','party_id','department_id','dep_th',
    'dep_en','party_th','party_en'];
    protected $dates=['deleted_at'];

    public function getappmem(){
      return $this->hasMany('App\Model\Masterdata\approve_mem','approve_func_id');
    }

    public function scopeGetmydep($value,$id){
      return $value->where(['department_id'=> auth()->user()->getdetail()->first()->code_dep,
    'function_id'=>$id]);
    }
}
