<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employee_resign_use extends Model
{
  use SoftDeletes;
  protected $dates=['deleted_at'];

  public function scopeEmp($query){
    $data=employee::find(auth()->user()->username);
    return ($data->dpm_code=='D020')?$query:$query->where(['code_dep'=> $data->code_dep,'code'=>auth()->user()->username]);
  }

  public function scopeCheckuse($query){
    return $query->where('replace',1);
  }
}
