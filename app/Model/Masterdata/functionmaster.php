<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;

class functionmaster extends Model
{
    protected $table='functions';
    public $timestamps=false;

    public function getappfunc()
    {
      return $this->hasMany('App\Model\Masterdata\approve_func','function_id');
    }
}
