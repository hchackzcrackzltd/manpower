<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class company extends Model
{
  use SoftDeletes;
    protected $fillable=['name'];
    protected $dates=['deleted_at'];
}
