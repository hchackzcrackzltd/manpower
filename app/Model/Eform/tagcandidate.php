<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;

class tagcandidate extends Model
{
    protected $fillable=['form_id','posit','exp','edu','sex','eq','iq','age'];
    public $timestamps=false;

    public function scopeTag($value,$data)
    {
      return $value->where([['posit','LIKE',"%{$data['posit']}%"],['sex','LIKE',($data['sex']==100)?'%':"{$data['sex']}"],['edu','LIKE',(isset($data['edu']))?"%{$data['edu']}%":'%']])
      ->whereBetween('age',explode(';',$data['age']))->whereBetween('exp',explode(';',$data['exp']))->whereBetween('eq',explode(';',$data['eq']))->whereBetween('iq',explode(';',$data['iq']));
    }
}
