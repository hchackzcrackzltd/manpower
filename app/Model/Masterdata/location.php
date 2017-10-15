<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class location extends Model
{
  use SoftDeletes;
    protected $fillable=['location'];
    protected $dates=['deleted_at'];
}
