<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class resign extends Model
{
  use SoftDeletes;
  public $incrementing=false;
  public $dates=['deleted_at'];
    protected $fillable=['id','user_id','user_em_id','time_str','time_agn',
    'time_end','effect_date','status','remark','rate','comment','em_remark'
    ,'code','last_date','reason','approve','docnum'];

    public function getmyapp()
    {
      return $this->hasMany('App\Model\Masterdata\approve', 'request_id');
    }
}
