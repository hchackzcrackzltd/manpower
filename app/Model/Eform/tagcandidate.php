<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tagcandidate extends Model
{
  use SoftDeletes;
    public $timestamps=false;
    protected $fillable=['form_id','posit','exp','edu','sex','eq','iq','age'];
}
