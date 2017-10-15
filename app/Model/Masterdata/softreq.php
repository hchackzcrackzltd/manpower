<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class softreq extends Model
{
  use SoftDeletes;
  public $dates=['deleted_at'];
}
