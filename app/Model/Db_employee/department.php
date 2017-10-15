<?php

namespace App\Model\Db_employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class department extends Model
{
    protected $connection='mysql';
    protected static function boot()
    {
      parent::boot();
      static::addGlobalScope('status',function(Builder $value){
        $value->where('status', 0);
      });
    }
    public function getRouteKeyName(){
      return 'code';
    }
}
