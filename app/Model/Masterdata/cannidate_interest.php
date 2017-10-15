<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;

class cannidate_interest extends Model
{
    protected $fillable=['cannidate_id','user_id','position_id','manpower_id'];

    public function scopeGetcannidate($value,$id){
      $con=explode(',',$id);
      return $value->where(['user_id'=>auth()->user()->username,
      'position_id'=>$con[0],'cannidate_id'=>$con[1]]);
    }

    public function scopeGetinterestcannidate($query,$id){
      return $query->leftJoin('cannidates','cannidates.id','=','cannidate_interests.cannidate_id')
      ->where('cannidate_interests.manpower_id',$id)->select('cannidates.*');
    }
}
