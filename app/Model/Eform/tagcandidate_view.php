<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tagcandidate_view extends Model
{
  use SoftDeletes;
  public function scopeTag($value,$data)
  {
    return $value->where([['posit','LIKE',"%{$data['posit']}%"],['sexfm','LIKE',($data['sex']==100)?'%':"{$data['sex']}"],['edu','LIKE',(isset($data['edu']))?"%{$data['edu']}%":'%']])
    ->whereBetween('age',explode(';',$data['age']))->whereBetween('exp',explode(';',$data['exp']))->whereBetween('eq',explode(';',$data['eq']))->whereBetween('iq',explode(';',$data['iq']));
  }
}
