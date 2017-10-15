<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;

class employee_new extends Model
{
    public $timestamps=false;
    protected $fillable=['id','code','name_en','name_th','date_work'];
}
