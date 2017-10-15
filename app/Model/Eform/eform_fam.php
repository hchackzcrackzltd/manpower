<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class eform_fam extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
      'form_id',
      'no',
      'name',
      'age',
      'op',
    ];
}
