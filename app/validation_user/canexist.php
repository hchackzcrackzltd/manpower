<?php
namespace App\validation_user;

use App\Model\Masterdata\cannidate_interest;

class canexist
{
  public function checkcanexist($attr,$value,$para,$validator)
  {
    return empty(cannidate_interest::where(['cannidate_id'=>$para[0],'user_id'=>auth()->user()->username,'manpower_id'=>$value])->first());
  }
}
