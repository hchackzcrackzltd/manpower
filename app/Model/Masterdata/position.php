<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class position extends Model
{
  use SoftDeletes;
  public $timestamps=false;
  protected $fillable=['name','department_id','grade','user_imd_id'];
  protected $dates = ['deleted_at'];

  public function scopeGetpositdep($query){
    return $query->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
  ->selectRaw("departments.name AS dep,positions.*");
  }

  public function scopeGetallposition($value,$data){
    return $value->whereIn('id', explode(',',$data));
  }

  public function department(){
    return $this->hasMany('App\Model\Masterdata\department','id','department_id');
  }
}
