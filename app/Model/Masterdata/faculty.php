<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class faculty extends Model
{
  use SoftDeletes;
    public $timestamps=false;
    protected $fillable=['name'];
    protected $dates = ['deleted_at'];
}
