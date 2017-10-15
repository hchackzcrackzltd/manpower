<?php

namespace App\Model\Db_employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class party extends Model
{
    protected $connection='mysql';
    protected $table='party';
    protected static function boot(){
      parent::boot();
      static::addGlobalScope('status', function(Builder $value)
      {
        $value->where('status',0);
      });
    }
    public function getRouteKeyName(){
      return 'code';
    }
    public function getdep(){
      return $this->hasMany('App\Model\Db_employee\department','party_code','code');
    }
}
