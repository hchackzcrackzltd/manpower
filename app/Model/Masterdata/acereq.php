<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class acereq extends Model
{
  use SoftDeletes;
  protected $dates=['deleted_at'];

  public function scopeSelectac($value,$data){
    return $value->where('grade', '<=',$data);
  }
}
