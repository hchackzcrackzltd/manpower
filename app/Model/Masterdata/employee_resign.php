<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Masterdata\employee;

class employee_resign extends Model
{
  use SoftDeletes;
  protected $dates=['deleted_at'];
    protected $fillable=['id','code_dep','replace'];
}
