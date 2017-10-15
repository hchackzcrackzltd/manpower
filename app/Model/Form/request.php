<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;
use App\Model\Masterdata\faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class request extends Model
{
  use SoftDeletes;
  public $incrementing=false;
    protected $fillable=['id','time_str','time_end','effect_date','position_id',
    'rfm_id','ren_name','jt_id','tw_lead','tw_lead_type','jd','sex',
    'count','age','edu_id','fac_id','exp','exp_year','qua'
    ,'com_id','sw','sw_etc_spc','ac','ac_etc_spc','fedc','car','car_lp','nmc','ofa'
    ,'user_id','status','user_em_id','remark','time_agn','rate','comment','emp_name'
    ,'emp_name_th','date_work','em_remark','em_type','location','company','rfm_nfb'
    ,'approve','imd_id','rfm_emp_id'];

    public function getmyapp()
    {
      return $this->hasMany('App\Model\Masterdata\approve', 'request_id');
    }
}
