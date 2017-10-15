<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;

class cannidate_attach extends Model
{
  public $timestamps=false;
    protected $fillable=['cannidate_id','file','name'];
}
