<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\User\user_dashboard_detail;

class cannidate extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=['name_th','name_en','position','interest','emp_id'];

    public function scopeUcan($value,user_dashboard_detail $data)
    {
      return $value->where('position','LIKE',"%{$data->position_id},%")->
      orWhere('position','LIKE',"%,{$data->position_id}")->
      orWhere('position','LIKE',"{$data->position_id}");
    }
}
