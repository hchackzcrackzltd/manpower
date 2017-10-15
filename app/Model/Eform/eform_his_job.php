<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class eform_his_job extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
      'form_id',
      'no',
      'type',
      'name',
      'address',
      'strdate',
      'enddate',
      'posit',
      'respon',
      'ref',
      'rel',
      'tel',
      'resign',
    ];
}
