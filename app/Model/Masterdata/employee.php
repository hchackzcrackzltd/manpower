<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class employee extends Model
{
  protected $connection='mysql';
  protected $table='employee_com';

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope('active', function(Builder $value)
    {
      $value->where('status','A');
    });
  }

  public function getEmpTypeAttribute($value){
    return ($value==='D')?'Daily':'Monthly';
  }

  public function getBranchCodeAttribute($value){
    return ($value==='HO')?'HO':'RJN';
  }

  public function scopeGetapp($value,$id){
    return $value->whereIn('party_code',[$id,'PT010','PT001'])->
    orderBy('party_code','asc');
  }

  public function scopeMlevel($value)
  {
    return $value->where('clevel','>=', 3);
  }
}
