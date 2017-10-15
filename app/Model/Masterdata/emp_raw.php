<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class emp_raw extends Model
{
    protected $connection='mysql';
    protected $table='employees';
    protected $primaryKey='code';
    public $timestamps = false;
    protected $fillable=['syng','fistsignin'];

    protected static function boot()
    {
      parent::boot();
      static::addGlobalScope('active', function(Builder $value){
        $value->where('status','A');
      });
    }
}
